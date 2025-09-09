<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])

<!-- CKEditor 5 Styles - Load once globally -->
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css">
<link rel="stylesheet" href="{{ asset('css/ckeditor-dark.css') }}">

<!-- WYSIWYG Content Styles - Override Tailwind CSS -->
<link rel="stylesheet" href="{{ asset('css/wysiwyg-content.css') }}?v={{ time() }}">

<script>
    // Force dark mode
    document.documentElement.classList.add('dark');
</script>
