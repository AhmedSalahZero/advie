<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

@if(session()->has('success'))

    <script>

        $(document).ready(function(){

            toastr.error('', "{{(session()->get('success'))}}",{

                // tap to dismiss
                tapToDismiss: true,

                // toast class
                toastClass: 'toast',

                // container ID
                containerId: 'toast-container',

                // debug mode
                debug: false,

                // fadeIn, slideDown, and show are built into jQuery
                showMethod: 'fadeIn',

                // duration of animation
                showDuration: 900,

                // easing function
                showEasing: 'swing',

                // callback function
                onShown: undefined,
                onHidden: undefined,

                // hide animation
                hideMethod: 'fadeOut',

                // duration of animation
                hideDuration: 1000,

                // easing function
                hideEasing: 'swing',

                // close animation
                closeMethod: false,

                // duration of animation
                closeDuration: false,

                // easing function
                closeEasing: false,

                // timeout in ms
                extendedTimeOut: 1000,

                // you can customize icons here
                iconClasses: {
                    error: 'toast-error',
                    info: 'toast-info',
                    success: 'toast-success',
                    warning: 'toast-warning'
                },
                iconClass: 'toast-success',

                // toast-top-center, toast-bottom-center, toast-top-full-width
                // toast-bottom-full-width, toast-top-left, toast-bottom-right
                // toast-bottom-left, toast-top-right
                positionClass: 'toast-top-center',

                // set timeOut and extendedTimeOut to 0 to make it sticky
                timeOut: 3000,

                // title class
                titleClass: 'toast-title',

                // message class
                messageClass: 'toast-message',

                // allows HTML content in the toast?
                escapeHtml: false,

                // target container
                target: 'body',

                // close button
                closeHtml: '<button type="button">&times;</button>',

                // place the newest toast on the top
                newestOnTop: true,

                // revent duplicate toasts
                preventDuplicates: false,

                // shows progress bar
                progressBar: true

            })

        })
    </script>
    <style>
        #toast-container{
            position:fixed;
            z-index: 999999;
            pointer-events: none;
            /*overrides*/
            font-size: 20px;


        }


    </style>
<style>
    #toast-container{
        position:fixed;
        z-index: 999999;
        pointer-events: none;
        /*overrides*/
        font-size: 20px;


    }
    </style>


@endif

@if(session()->has('fail'))
    <script>
        $(document).ready(function(){

            toastr.error('', "{{session()->get('fail')}}",{

                // tap to dismiss
                tapToDismiss: true,

                // toast class
                toastClass: 'toast',

                // container ID
                containerId: 'toast-container',

                // debug mode
                debug: false,

                // fadeIn, slideDown, and show are built into jQuery
                showMethod: 'fadeIn',

                // duration of animation
                showDuration: 900,

                // easing function
                showEasing: 'swing',

                // callback function
                onShown: undefined,
                onHidden: undefined,

                // hide animation
                hideMethod: 'fadeOut',

                // duration of animation
                hideDuration: 1000,

                // easing function
                hideEasing: 'swing',

                // close animation
                closeMethod: false,

                // duration of animation
                closeDuration: false,

                // easing function
                closeEasing: false,

                // timeout in ms
                extendedTimeOut: 1000,

                // you can customize icons here
                iconClasses: {
                    error: 'toast-error',
                    info: 'toast-info',
                    success: 'toast-success',
                    warning: 'toast-warning'
                },
                iconClass: 'toast-error',

                // toast-top-center, toast-bottom-center, toast-top-full-width
                // toast-bottom-full-width, toast-top-left, toast-bottom-right
                // toast-bottom-left, toast-top-right
                positionClass: 'toast-top-center',

                // set timeOut and extendedTimeOut to 0 to make it sticky
                timeOut: 3000,

                // title class
                titleClass: 'toast-title',

                // message class
                messageClass: 'toast-message',

                // allows HTML content in the toast?
                escapeHtml: false,

                // target container
                target: 'body',

                // close button
                closeHtml: '<button type="button">&times;</button>',

                // place the newest toast on the top
                newestOnTop: true,

                // revent duplicate toasts
                preventDuplicates: false,

                // shows progress bar
                progressBar: true

            })

        })
    </script>
    <style>
        #toast-container{
            position:fixed;
            z-index: 999999;
            pointer-events: none;
            /*overrides*/
            font-size: 20px;


        }


    </style>
@endif


@if(session()->has('errors'))
    <script>

        $(document).ready(function(){

            toastr.error('', "{{(session()->get('errors')->first())}}",{

                // tap to dismiss
                tapToDismiss: true,

                // toast class
                toastClass: 'toast',

                // container ID
                containerId: 'toast-container',

                // debug mode
                debug: false,

                // fadeIn, slideDown, and show are built into jQuery
                showMethod: 'fadeIn',

                // duration of animation
                showDuration: 900,

                // easing function
                showEasing: 'swing',

                // callback function
                onShown: undefined,
                onHidden: undefined,

                // hide animation
                hideMethod: 'fadeOut',

                // duration of animation
                hideDuration: 1000,

                // easing function
                hideEasing: 'swing',

                // close animation
                closeMethod: false,

                // duration of animation
                closeDuration: false,

                // easing function
                closeEasing: false,

                // timeout in ms
                extendedTimeOut: 1000,

                // you can customize icons here
                iconClasses: {
                    error: 'toast-error',
                    info: 'toast-info',
                    success: 'toast-success',
                    warning: 'toast-warning'
                },
                iconClass: 'toast-error',

                // toast-top-center, toast-bottom-center, toast-top-full-width
                // toast-bottom-full-width, toast-top-left, toast-bottom-right
                // toast-bottom-left, toast-top-right
                positionClass: 'toast-top-center',

                // set timeOut and extendedTimeOut to 0 to make it sticky
                timeOut: 3000,

                // title class
                titleClass: 'toast-title',

                // message class
                messageClass: 'toast-message',

                // allows HTML content in the toast?
                escapeHtml: false,

                // target container
                target: 'body',

                // close button
                closeHtml: '<button type="button">&times;</button>',

                // place the newest toast on the top
                newestOnTop: true,

                // revent duplicate toasts
                preventDuplicates: false,

                // shows progress bar
                progressBar: true

            })

        })
    </script>
    <style>
        #toast-container{
            position:fixed;
            z-index: 999999;
            pointer-events: none;
            /*overrides*/
            font-size: 20px;


        }


    </style>
@endif






