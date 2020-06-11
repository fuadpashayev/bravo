let pashayev = {
    notify: function(options) {
        Noty.overrideDefaults({
            theme: 'limitless',
            layout: 'topRight',
            type: 'alert',
            timeout: 2500,
            ...options
        });

        new Noty().show();
    },
    alert: function(options){
        options = {
            title: '<span data-lang="magusCommon.information"></span>',
            content: '',
            text: '',
            type: 'info',
            showCancelButton: false,
            confirmButtonColor: "#263238",
            confirmButtonText: 'Close',
            redirectUrl: '',
            allowEscapeKey: false,
            html: true,
            delay:0,
            ...options,
        };
        let callback = options.callback || function(){};
        setTimeout(function(){
            swal(options,function(){
                callback();
                if (options.redirectUrl) {
                    let currentUrl = document.location.href.split(window.location.origin)[1];
                    if(options.redirectUrl === 'reload' || options.redirectUrl===currentUrl){
                        document.location.reload()
                    }else{
                        document.location.href = options.redirectUrl;
                    }
                }
            });
        },options.delay);
        pashayev.stopLoader();
    },
    confirm: function(message,callback = function(){}) {
        message = message || 'Are you sure to delete the data?';
        swal({
            title: message,
            type: "warning",
            showCancelButton: true,
            cancelButtonText: pashayev.translate('common.yes'),
            confirmButtonText: pashayev.translate('common.cancel'),
            confirmButtonColor: "#EF5350",
            allowEscapeKey: false,
            closeOnConfirm: true,
            closeOnCancel: false,
            html: true
        }, function (isConfirm) {
            swal.close();
            if (!isConfirm) {
                callback(true);
            } else {
                callback(false);
            }
        });
        pashayev.stopLoader();
    },
    startIframe:function(url){
        pashayev.startLoader();
        $('#iframe-content').load(`${url} .content-wrapper,script`,function(result,message){
            let scripts = $(result).filter((key,element) => element.tagName==='SCRIPT');
            scripts.each((index,element) => {
                if(element.outerHTML.match('<script>')) eval($(element).html())
            });
            if(message==="error"){
                let data = $(result).find('.content-wrapper')[0];
                $('#iframe-content').html(data);
            }
            pashayev.stopLoader();
            $('#iframe-layer').addClass('show').find('#iframe').removeClass('bounceOut').addClass('animated bounceIn');
            $('body').css('overflow','hidden');
        });
    },
    stopIframe:function(){
        $('#iframe-layer').find('#iframe').removeClass('bounceIn').addClass('animated bounceOut');
        setTimeout(function(){
            $('#iframe-content').text('').parents('#iframe-layer').removeClass('show');
            $('body').css('overflow','inherit');
        },750);
    },

    startModal:function(options={}){
        options = {
            title:'Modal title',
            content:'Modal content',
            buttonCancelText: pashayev.translate('buttons.cancel'),
            buttonOkayText: pashayev.translate('buttons.okay'),
            additionalButtons:'',
            relationId:'',
            focusSelector:null,
            okayListener:null,
            onOkay:function(){},
            onCancel:function(){},
            ...options
        };

        options.buttonCancel = options.buttonCancelText?`<button class="btn btn-danger modal-close">${options.buttonCancelText}</button>`:'';
        options.buttonOkay = options.buttonOkayText?`<button class="btn bg-slate" id="modal-okay">${options.buttonOkayText}</button>`:'';

        $('#modal-layer').addClass('show').find('#modal').removeClass('bounceOut').addClass('animated bounceIn');
        $('body').css('overflow','hidden');
        $('#modal-title').html(options.title).show();
        $('#modal-content').html(options.content).show();
        $('#modal-buttons').html(`${options.additionalButtons} ${options.buttonCancel} ${options.buttonOkay}`).show();
        $('#modal-relation-id').html(options.relationId);
        if(options.focusSelector){
            $('#modal-content').find(options.focusSelector).click().focus();
        }

        $(document).one('click', '#modal-close,.modal-close', function () {
            pashayev.stopModal();
            options.onCancel();
        });

        $(document).one('click', '#modal-okay', function () {
            pashayev.stopModal();
            options.onOkay();
        });

        $(document).on('keydown', options.okayListener,function(e){
            if(e.which===13) $('#modal-okay').click();
        });

    },
    stopModal:function(){
        $('#modal-layer').find('#modal').removeClass('bounceIn').addClass('animated bounceOut');
        setTimeout(function(){
            $('#modal-content').text('').parents('#modal-layer').removeClass('show');
            $('#modal-title,#modal-content,#modal-buttons').html('');
            $('body').css('overflow','inherit');
        },750);
    },
    getCSRFToken: function(){
        return $("meta[name='csrf-token']").attr("content");
    },
    startLoader: function(){
        $('#loader').css({
            opacity:1,
            'z-index':999999
        });
    },
    stopLoader: function(){
        $('#loader').css({
            opacity:0,
            'z-index':0
        });
    },
    getCookie: function(name) {
        const v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
        return v ? v[2] : null;
    },
    setCookie: function(name, value, days) {
        const d = new Date;
        d.setTime(d.getTime() + 24*60*60*1000*days);
        document.cookie = name + "=" + value + ";path=/;expires=" + d.toGMTString();
    },
    removeCookie: function(name){
        this.setCookie(name, '', -1);
    },
    translateText: function(text,from,to){
        pashayev.startLoader();
        if(text.length>0){
            let url = `${yandexUrl}&text=${text}&lang=${from}-${to}`;
            $.get(url,function(translatedData){
                $(`#${to}`).val(translatedData.text[0]);
                pashayev.stopLoader();
            });
        }else{
            pashayev.alert({
                type:'error',
                text:'Tərcümə ediləcək mətni yazmamısınız!'
            });
        }
    },
    setTranslations:function(){
        allLocales.forEach(function (locale) {
           $.get(`/langs/${locale}.json`,function(langData){
               localStorage.setItem(locale,JSON.stringify(langData));
           }) ;
        });
        this.setCookie('lang',true,365);
    },
    translate:function(string) {
        let translations = localStorage.getItem(locale);
        if(!translations){
            this.setTranslations();
            return;
        }
        translations = JSON.parse(translations);
        let [group, translation] = string.split('.');
        if(!translations[group] || !translations[group][translation]){
            return string;
        }
        let translated = translations[group][translation];
        return translated||string;
    },
    translateWithAttribute:function(string,attributes = null) {
        let translations = localStorage.getItem(locale);
        if(!translations){
            this.setTranslations();
            return;
        }
        translations = JSON.parse(translations);
        let [group, translation] = string.split('.');
        if(!translations[group] || !translations[group][translation]){
            return string;
        }
        let translated = translations[group][translation];
        if(attributes){
            Object.keys(attributes).forEach(function(attribute){
                let value = attributes[attribute];
                translated = translated.replace(new RegExp(`#{${attribute}}`,'ig'),value);
            });
        }
        return translated||string;
    },
    fullscreen:function(){
        let elem = document.documentElement;
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) { /* Firefox */
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { /* IE/Edge */
            elem.msRequestFullscreen();
        }
    },
    exitFullscreen: function(){
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.mozCancelFullScreen) { /* Firefox */
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) { /* IE/Edge */
            document.msExitFullscreen();
        }
    },
    getFormData: function(form){
        let formData = form.serializeJSON();
        delete formData._token;
        return formData;
    },
    request:function(options){
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': this.getCSRFToken()}});
        let restMethods = ['delete','put'];
        if(restMethods.includes(options.method)){
            if(!options.input) options.input = {};
            options.input._method = options.method;
            options.method = 'post';
        }
        $.ajax({
            url:options.url,
            type:options.method || 'post',
            data:options.input,
            headers:options.headers || {'Accept': 'application/json'},
            success: function (response) {
                options.success(response);
            },
            error: function (error) {
                if(options.error){
                    options.error(error.responseJSON);
                }else{
                    pashayev.alert({
                        type:'error',
                        text:error.responseJSON.message
                    });
                }
            }
        });
    },
    getSelecteds(area){
        /****Selects from all pages / START*****/
        // let rows = $(".translationTable").dataTable().$('tr', {"filter": "applied"});
        // $.each(rows, function () {
        //     let row = $($(this).find('td').eq(0)).find('input');
        //     if(row.is(':checked'))
        //         selecteds.push(row.val());
        // });
        /****Selects from all pages / END *****/



        let selecteds = [];
        if(typeof area === "object"){
            let selectedsNodes = area.find(`input:not(.selectAll):checked`);
            selectedsNodes.each(function(){
                let node = $(this);
                selecteds.push(node.val());
            });
        }else{
            let selectedsNodes = document.querySelectorAll(`${area} input:not(.selectAll):checked`);
            selectedsNodes.forEach(node => {
               selecteds.push(node.value);
            });
        }

        return selecteds;
    },
    rand: function(min, max) {
        min = min || 0;
        max = max || Number.MAX_SAFE_INTEGER;
        return Math.floor(Math.random() * (max - min + 1)) + min;
    },
    selectMedia:function(callback=function(){}){
        let params = [
            'height='+Number(screen.height-200),
            'width='+Number(screen.width-200),
            'fullscreen=yes'
        ].join(',');
        let popup=window.open(mediaUrl,"_blank", params);
        popup.moveTo(10,10);
        $(document).on('mediaSelected',function (e,data) {
            callback(data.gallery);
        })
    },
    editor:function(selector){
        CKEDITOR.replace(selector);
    },
    getYoutubeIdFromUrl:function(url) {
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
        const match = url.match(regExp);

        return (match && match[2].length === 11)
            ? match[2]
            : null;
    },
    generateYoutubeEmbedUrl:function(url){
        return `https://www.youtube.com/embed/${this.getYoutubeIdFromUrl(url)}?enablejsapi=1`;
    }

};

function getSelectedImage(url,gallery){
    //gallery = gallery.length===1?gallery[0]:gallery;
    $(document).trigger('mediaSelected',[{gallery}]);
}



$(function(){
    if(pashayev.getCookie('lang')!=="true"){
        pashayev.setTranslations();
    }
});
