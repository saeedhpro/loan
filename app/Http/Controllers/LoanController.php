<?php

namespace App\Http\Controllers;

use App\Events\ActionOnLoanRequestDone;
use App\Events\ActionOnLoanRequestDoneEvent;
use App\Http\Requests\LoanActionRequest;
use App\Http\Requests\LoanRequest;
use App\Interfaces\LoanInterface;
use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class LoanController extends Controller
{
    protected LoanInterface $loanRepository;

    public function __construct(
        LoanInterface $loanRepository,
    )
    {
        $this->loanRepository = $loanRepository;
    }

    public function index()
    {
        if (!$this->can('request_loan')) {
            abort(403);
        }
        $status = \request()->get('status') ?? '';
        $from = \request()->get('from') ?? '';
        $to = \request()->get('to') ?? '';
        $page = $this->getPage();
        $limit = $this->getLimit();
        $userId = $this->getAuth()->id;
        $filters = [];
        if ($status) {
            $filters['status'] = $status;
        }
        if ($userId) {
            $filters['user_id'] = $userId;
        }
        if ($from) {
            $filters['from'] = $from;
        }
        if ($to) {
            $filters['to'] = $to;
        }
        $loans = $this->loanRepository->searchLoanRequestsByPagination($filters, $page, $limit);
        return view('loans.index', compact('loans'))->with('filters', $filters);
    }

    public function loanRequests()
    {
        if (!$this->can('index_request_loans')) {
            abort(403);
        }
        $status = \request()->get('status') ?? '';
        $userId = \request()->get('user_id') ?? '';
        $from = \request()->get('from') ?? '';
        $to = \request()->get('to') ?? '';
        $page = $this->getPage();
        $limit = $this->getLimit();
        $filters = [];
        if ($status) {
            $filters['status'] = $status;
        }
        if ($userId) {
            $filters['user_id'] = $userId;
        }
        if ($from) {
            $filters['from'] = $from;
        }
        if ($to) {
            $filters['to'] = $to;
        }
        $loans = $this->loanRepository->searchLoanRequestsByPagination($filters, $page, $limit);
        return view('loans.requests.index', compact('loans'))->with('filters', $filters);
    }

    public function showRequestLoan()
    {
        if (!$this->can('request_loan')) {
            abort(403);
        }
        $success = false;
        $error = '';
        return view('loans.request', compact('success', 'error'));
    }

    public function store(LoanRequest $request)
    {
        if (!$this->can('request_loan')) {
            abort(403);
        }
        $auth = $this->getAuth();
        if ($auth->loans()->where('status', 'created')->count() > 0) {
            $error = 'شما یک درخواست وام بررسی نشده دارید';
            $success = false;
            return view('loans.request', compact('success', 'error'))->with('input', $request->all());
        }
        $data = [
            'user_id' => $auth->id,
            'amount' => $request->get('amount'),
            'status' => 'created'
        ];
        $this->loanRepository->create($data);
        $success = true;
        $error = '';
        return view('loans.request', compact('success', 'error'));
    }

    public function show(int $id)
    {
        if (!$this->can('request_loan') && !$this->can('index_request_loans')) {
            abort(403);
        }
        $loan = $this->loanRepository->findOneOrFail($id);
        $success = false;
        $error = '';
        return view('loans.requests.show', compact('loan', 'success', 'error'));
    }

    public function action(LoanActionRequest $request, int $id)
    {
        if (!$this->can('accept_reject_loan')) {
            abort(403);
        }
        $auth = $this->getAuth();
        /** @var Loan $loan */
        $loan = $this->loanRepository->findOneOrFail($id);
        if ($loan->status != 'created') {
            return redirect()->back()->withInput($request->all())->withErrors(['error' => 'این درخواست پیشتر بررسی شده است', 'status' => false]);
        }
        DB::beginTransaction();
        try {
            $action = $request->get('action');
            /** @var User $user */
            $user = $loan->user;
            $data = [
                'status' => $request->get('action'),
                'approver_id' => $auth->id,
            ];
            if ($action == 'accepted') {
                $data['accepted_at'] = Carbon::now();
            }
            if ($action == 'rejected') {
                $data['rejected_at'] = Carbon::now();
            }
            $loan->update($data);
            $user->update([
                'amount' => $user->amount + $loan->amount,
            ]);
            DB::commit();
            event(new ActionOnLoanRequestDoneEvent($loan));
            return redirect()->back()->withInput($request->all())->withErrors(['error' => '', 'status' => true])->with(['error' => '', 'status' => true]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withInput($request->all())->withErrors(['error' => 'این درخواست پیشتر بررسی شده است', 'status' => false]);
        }
    }
}
