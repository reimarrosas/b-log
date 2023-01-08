<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Bulma: CSS Framework --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css"
        integrity="sha512-HqxHUkJM0SYcbvxUw5P60SzdOTy/QVwA1JJrvaXJv4q7lmbDZCmZaqz01UPOaQveoxfYRv1tHozWGPMcuTBuvQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- AlpineJS: JavaScript Framework --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- FontAwesome Font Kit --}}
    <script src="https://kit.fontawesome.com/659ec9636a.js" crossorigin="anonymous"></script>

    {{-- QuillJS: WYSIWYG Editor --}}
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    @vite('resources/js/app.js')
    @vite('resources/css/app.css')

    <title>B-Log | {{ $title ?? 'Home' }}</title>
</head>

<body class="has-navbar-fixed-top">
    <x-navbar />
    {{ $slot }}
    @if (session()->has('login_success'))
        <x-flash :flash_name="'login_success'" />
    @endif
</body>
{{ $scripts ?? '' }}

</html>
