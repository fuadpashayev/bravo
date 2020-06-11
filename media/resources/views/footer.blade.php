<script>
    let locale = '{{getLocale()}}';
    let locales = {!! (getLocales()) !!};
    let allLocales = locales;
    let yandexUrl = '{{yandexUrl()}}';
</script>
@foreach(config('media.libraries.javascript', []) as $js)
    <script src="{{ url($js) }}" type="text/javascript"></script>
@endforeach
