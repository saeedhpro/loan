import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// $('#create-employer').on('submit', function (e) {
//     {{--e.preventDefault()--}}
//     {{--const data = [];--}}
//     {{--let csrf = $('#csrf').val()--}}
//     {{--let name = $('#name').val();--}}
//     {{--let last_name = $('#last_name').val();--}}
//     {{--let username = $('#username').val();--}}
//     {{--let role = $('#role').val();--}}
//     {{--let permissions = [];--}}
//     {{--$('#permissions input:checked').each(function() {--}}
//         {{--    permissions.push($(this).val());--}}
//         {{--});--}}
//     {{--data['name'] = name--}}
//     {{--data['last_name'] = last_name--}}
//     {{--data['username'] = username--}}
//     {{--data['role'] = role--}}
//     {{--data['permissions'] = permissions--}}
//     {{--$.ajax({--}}
//         {{--    headers: {--}}
//             {{--        'X-CSRF-TOKEN': csrf--}}
//             {{--    },--}}
//         {{--    data: data,--}}
//         {{--    url: "{{route('dashboard.employer.store')}}",--}}
//         {{--    method: "POST"--}}
//         {{--})--}}
//     {{--    .then(res => {--}}
//         {{--        console.log(res, "res")--}}
//         {{--    })--}}
//     {{--    .catch(err => {--}}
//         {{--        const errors = err.responseJSON.errors--}}
//         {{--        console.log($('#name_error'))--}}
//         {{--        console.log(errors, "err")--}}
//         {{--    })--}}
// })
