<x-HeaderMenuAdmin>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Schedule Table</title>
         @livewireStyles
    </head>
    <body>

        @php
            $parameter = request()->route('parameter');
        @endphp
        <livewire:update-formateur :product-id="$productId"/>
        <x-livewire-alert::scripts />
        @livewireScripts

    </body>
    </html>
</x-Headers>



