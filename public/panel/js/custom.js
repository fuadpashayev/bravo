!function (e, t) {
    void 0 === e && void 0 !== window && (e = window), "function" == typeof define && define.amd ? define(["jquery"], function (e) {
        return t(e)
    }) : "object" == typeof module && module.exports ? module.exports = t(require("jquery")) : t(e.jQuery)
}(this, function (e) {
    e.fn.selectpicker.defaults = {
        noneSelectedText: pashayev.translate('options.nothingSelected'),
        noneResultsText: pashayev.translate('options.nothingMatched'),
        countSelectedText: function (e, t) {
            return 1 === e ? pashayev.translate('options.selectedItem') : pashayev.translate('options.selectedItems')
        },
        maxOptionsText: function (e, t) {
            return [1 === e ? "Limit reached ({n} item max)" : "Limit reached ({n} items max)", 1 == t ? "Group limit reached ({n} item max)" : "Group limit reached ({n} items max)"]
        },
        selectAllText: "Select All",
        deselectAllText: "Deselect All",
        multipleSeparator: ", "
    }
});

Array.prototype.where = function(key,value){
    return this.filter(data => data[key]===value);
}


const CONSTANTS = {
    SUCCESS: 'success',
    ERROR: 'error'
};

let chars = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '+'];

function shuffle(array) {
    return array.sort(() => Math.random() - 0.5);
}

function uniqid() {
    return shuffle(chars).join('').substring(5, 25);
}

function randomString() {
    return Math.random().toString(36).substr(2, 26);
}

$(document).on('click', 'a[data-false]', function () {
    return false;
});

$(document).on('click', '.show-more', function () {
    $(this).next('.more-data').css('display', 'inline').end().hide();
});

$(document).on('click', '.show-less', function () {
    $(this).parents('.more-data').hide().siblings('.show-more').show();
});

$(function () {
    $(document).find('.switchery').each(function () {
        new Switchery($(this)[0])
    });
});

$(document).on('click', '#iframe-close', function () {
    pashayev.stopIframe();
});

$(document).on('click', '.editData,.addData', function (e) {
    e.preventDefault();
    let url = $(this).attr('href');
    pashayev.startIframe(url);
});

$(document).on('click', '.delete', function () {
    let type = $(this).data('type');
    let model = $(this).data('model');
    let data = $(this).data('id');
    let $this = $(this);
    let confirmMessage = pashayev.translateWithAttribute('common.deleteConfirmMessage', {type});
    pashayev.confirm(confirmMessage, function (isConfirmed) {
        if (isConfirmed) {
            pashayev.startLoader();
            pashayev.request({
                url: `/admin/${model}/${data}`,
                method: 'delete',
                success: function (result) {
                    pashayev.stopLoader();
                    pashayev.alert({
                        type: 'success',
                        text: result.message,
                        delay:100,
                        callback: function () {
                            $this.parents('tr[role=row]').remove();
                        }
                    });
                }
            });
        }
    });
});

locales = locales.filter(lang => lang !== locale);

$(document).on('click', '.translate', function () {
    let text = $(this).parents('.input-group').find('input').val().trim();
    locales.forEach(function (lang) {
        pashayev.translateText(text, locale, lang);
    });
});

$(document).on('click', '.submitAJAX', function (e) {
    e.preventDefault();
    if(typeof beforeSubmit === "function") beforeSubmit();
    pashayev.startLoader();
    let form = $(this).parents('form');
    let redirectUrl = $(form).data('reload') || '';
    pashayev.request({
        url: form[0].action,
        input: pashayev.getFormData(form),
        success: function (res) {
            pashayev.stopLoader();
            pashayev.alert({
                type: 'success',
                text: res.message,
                delay:100,
                redirectUrl,
                callback: function () {
                    pashayev.stopIframe();
                },
            });
        },
        error: function (error) {
            let text = error.message;
            if (error.errors) {
                let errorKeys = Object.keys(error.errors);
                if(errorKeys.length > 0) errorKeys.forEach(errorKey => text += `<br/>${error.errors[errorKey]}`);
            }
            pashayev.stopLoader();
            pashayev.alert({
                type: 'error',
                text,
                delay:100,
            });
        }
    });
});


$(document).on('click', '.addInfo', function () {
    let infoId = randomString();
    let newInfo = `
        <div class="row">
            <div class="form-group px-0 pr-sm-1 col-lg-6 col-md-6 col-sm-6">
                <label for="name_${infoId}">${pashayev.translate('users.infoName')}</label>
                <input class="form-control" id="name_${infoId}" name="info_names[]">
            </div>
            <div class="form-group px-0 pl-sm-1 col-lg-6 col-md-6 col-sm-6">
                <label for="value_${infoId}">${pashayev.translate('users.infoValue')}</label>
                <div class="input-group">
                    <input class="form-control" id="value_${infoId}" name="info_values[]">
                    <div class="input-group-append">
                        <button class="btn bg-danger deleteInfo"><b><i class="icon-bin"></i></b></button>
                    </div>
                </div>
            </div>
        </div>
    `;
    $('#infos').append(newInfo);
});

$(document).on('click', '.deleteInfo', function () {
    $(this).parents('.row').remove();
});

$(document).on('click', '.generatePassword', function () {
    $(this).parents('.form-group').find('input').val(uniqid());
});

$(document).on('click','.selectAll',function(){
    let rows, checked;
    rows = $(this).parents('table').dataTable().$('tr', {"filter": "applied"});
    checked = $(this).prop('checked');
    $.each(rows, function () {
        $($(this).find('td').eq(0)).find('input').prop('checked', checked).trigger('selected');
    });
    $.uniform.update();
    let selecteds = pashayev.getSelecteds($(this).parents('table'));
    $('.deleteAll').attr('disabled',selecteds.length<=0);
});

$(document).on('change','[name="selecteds"]',function(){
    $(this).trigger('selected');
});

$(document).on('selected','[name="selecteds"]',function(){
    let selecteds = pashayev.getSelecteds($(this).parents('table')).length;
    let deleteText = selecteds>1?pashayev.translateWithAttribute('common.deleteNItems',{selecteds}):pashayev.translate('common.delete');
    $('.deleteAll').attr('disabled',selecteds<=0).find('>span').html(deleteText);
});

$(document).on('click','.deleteAll',function(){
    let area = $(this).parents('table');
    let model = area.data('model');
    let selecteds = pashayev.getSelecteds(area);
    let confirmMessage = pashayev.translateWithAttribute('common.deleteSelectedsConfirmMessage',{selecteds:selecteds.length});
    pashayev.confirm(confirmMessage, function (isConfirmed) {
        if (isConfirmed) {
            pashayev.startLoader();
            pashayev.request({
                url: `/admin/${model}/deleteSelecteds`,
                method: 'delete',
                input:{selecteds},
                success: function (result) {
                    // debugger
                    pashayev.stopLoader();
                    pashayev.alert({
                        type: 'success',
                        text: result.message,
                        redirectUrl:'reload',
                        delay:100,
                        callback: function () {
                            selecteds.forEach(selected => {
                                $(`input:checkbox[value=${selected}]`).parents('tr[role=row]').remove();
                            });
                        }
                    });
                }
            });
        }
    });
});

$(document).on('click','table tbody tr[role=row]',function(){
    let row = $(this);
    let focusClass = 'table-primary';
    row.parents('table').find(`.${focusClass}`).removeClass(focusClass);
    row.addClass(focusClass);
    // row.toggleClass('table-primary'); // multiple select
});

let appendedMedias = [];
$(document).on('click','#openMediaManager',function(){
    let single = false,title = false,dataType = false;
    if($(this).attr('data-media-select-type')==='single') single = true;
    if($(this).attr('data-media-title')==='true') title = true;
    if($(this).attr('data-type')==='titleAndText') dataType = true;
    pashayev.selectMedia(medias => {
        medias.forEach((media,index) => {
            if(!appendedMedias.includes(media.id)){
                let newMedia;
                if((single && index===0) || !single){
                    if(media.type==='video' && media.mime_type==='youtube'){
                        newMedia = `
                        <a href="${media.url}" class="fancybox" data-fancybox="media">
                            <div class="image" id="${media.id}">
                                <iframe src="${pashayev.generateYoutubeEmbedUrl(media.url)}"/>
                                ${title?`<div class="action textMedia"><i class="icon-pencil"></i></div>`:''}
                                <div class="action deleteMedia">×</div>
                                <div class="action showMedia"><i class="icon-eye"></i></div>
                                ${title?`<div class="caption-area" ${dataType?'data-type="titleAndText"':''} data-placeholder="${pashayev.translate('sliders.enterTitle')}"></div>`:''}
                                <input type="hidden" name="media[]" value="${media.id}">
                            </div>
                        </a>
                    `;
                    }else{
                        newMedia = `
                        <a href="${media.url}" class="fancybox" data-fancybox="media">
                            <div class="image" id="${media.id}">
                                <img src="${media.url}"/>
                                ${title?`<div class="action textMedia"><i class="icon-pencil"></i></div>`:''}
                                <div class="action deleteMedia">×</div>
                                <div class="action editMedia"><i class="icon-crop"></i></div>
                                <div class="action showMedia"><i class="icon-eye"></i></div>
                                ${title?`<div class="caption-area" ${dataType?'data-type="titleAndText"':''} data-placeholder="${pashayev.translate('sliders.enterTitle')}"></div>`:''}
                                <input type="hidden" name="media[]" value="${media.id}">
                            </div>
                        </a>
                    `;
                    }

                    if(single){
                        $('.media-area').html(newMedia);
                        appendedMedias = [media.id];
                    }else{
                        $('.media-area').append(newMedia);
                        appendedMedias.push(media.id);
                    }
                }
            }
        });
        $('#media').val(appendedMedias.join(','));
        $('empty').hide();
    });
});

let mediaTitles = {};
let mediaTexts = {};
$(document).on('click','.deleteMedia',function(e){
    e.stopPropagation();
    e.preventDefault();
    let mediaId = parseInt($(this).parent().attr('id'));
    appendedMedias.splice(appendedMedias.indexOf(mediaId),1);
    $(this).parents('.image').fadeOut(function(){
        $(this).remove();
    });
    $('#media').val(appendedMedias.join(','));
    delete mediaTitles[mediaId];
    if(!appendedMedias.length) setTimeout(function(){ $('empty').show(); },600);
});

let cropper = null;
$(document).on('click','.editMedia',function(e){
    e.stopPropagation();
    e.preventDefault();
    let media = $(this).siblings('img');
    let mediaId = parseInt($(this).parent().attr('id'));

    pashayev.startModal({
        title: pashayev.translate('Image editor'),
        buttonCancelText:false,
        buttonOkayText: pashayev.translate('buttons.save'),
        additionalButtons:`
            <div id="modal-additional-buttons">
                <div class="editor-group">
                    <button class="btn bg-slate editor-mode" data-mode="move" title="${pashayev.translate('media.move')}"><i class="icon-move"></i></button>
                    <button class="btn bg-slate editor-mode" data-mode="crop" title="${pashayev.translate('media.crop')}"><i class="icon-crop2"></i></button>
                </div>
                <button class="btn bg-slate editor-mode" data-mode="rotate_ccw" title="${pashayev.translate('media.rotate_ccw')}"><i class="icon-rotate-ccw3"></i></button>
                <button class="btn bg-slate editor-mode" data-mode="rotate_cw" title="${pashayev.translate('media.rotate_cw')}"><i class="icon-rotate-cw3"></i></button>
                <button class="btn bg-slate editor-mode" data-mode="flip_h" data-flipped="false" title="${pashayev.translate('media.rotate_h')}"><i class="icon-flip-vertical4"></i></button>
                <button class="btn bg-slate editor-mode" data-mode="flip_v" data-flipped="false" title="${pashayev.translate('media.rotate_v')}"><i class="icon-flip-vertical3"></i></button>
            </div>
        `,
        content:`<img width="100%" src="${media.attr('src')}" alt=""/>`,
        onOkay:function(){
            pashayev.startLoader();
            console.log(Date())
            let image = cropper.getCroppedCanvas().toDataURL("image/png");
            $.post('/admin/mediaUpload',{image,mediaId},function(response){
                pashayev.stopLoader();
                let imageArea = $(document).find(`#${mediaId}.image`);
                imageArea.attr('id',response.result.media.id).find('input').val(response.result.media.id);
                imageArea.find('img').attr('src',response.result.media.url)
                imageArea.parent().attr('href',response.result.media.url);
            });
        }
    });

    let cropMedia = $(document).find('#modal-content img')[0];

    cropper = new Cropper(cropMedia);

});

$(document).on('click','.textMedia,.caption-area',function(e){
    e.stopPropagation();
    e.preventDefault();
    let mediaId = parseInt($(this).parent().attr('id'));
    let dataType = $(this).attr('data-type');
    pashayev.startModal({
        title: pashayev.translate('media.imageText'),
        buttonCancelText:false,
        buttonOkayText: pashayev.translate('buttons.save'),
        focusSelector:'[id*=media-title]',
        okayListener:'[id*=media-title],[id*=media-text]',
        content:`
            <div class="row p-3">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="media-title-${mediaId}"><i class="icon-pencil5 title-icon"></i>${pashayev.translate('media.imageTitle')}</label>
                    <div class="input-group">
                        <input class="form-control" id="media-title-${mediaId}" value="${mediaTitles[mediaId]||''}">
                    </div>
                </div>
                ${dataType==='titleAndText'?`
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="media-text-${mediaId}"><i class="icon-file-text title-icon"></i>${pashayev.translate('media.imageText')}</label>
                        <div class="input-group">
                            <input class="form-control" id="media-text-${mediaId}" value="${mediaTexts[mediaId]||''}">
                        </div>
                    </div>
                `:''}
            </div>
        `,
        onOkay:function(){
            let newMediaTitle = $(document).find(`#media-title-${mediaId}`).val();
            mediaTitles[mediaId] = newMediaTitle;
            $(`#${mediaId}.image .caption-area`).text(newMediaTitle);

            mediaTexts[mediaId] = $(document).find(`#media-text-${mediaId}`).val();
        }
    });


})

let flipData={horizontal:1,vertical:1};
$(document).on('click','.editor-mode',function(){
    let mode = $(this).data('mode');
    let flipped = $(this).attr('data-flipped'),flip;
    if(cropper){
        switch (mode) {
            case 'move':
            case 'crop':
                cropper.setDragMode(mode);
                $(this).addClass('active').siblings('.editor-mode').removeClass('active');
                break;
            case 'rotate_ccw':
                cropper.rotate(-45);
                break;
            case 'rotate_cw':
                cropper.rotate(45);
                break;
            case 'flip_h':
                if(flipped==="true"){
                    cropper.scale(1,flipData["vertical"]);
                    flip = false;
                }else{
                    cropper.scale(-1,flipData["vertical"]);
                    flip = true;
                }
                flipData["horizontal"] = flip?-1:1;
                $(this).attr('data-flipped',flip);
                break;
            case 'flip_v':
                if(flipped==="true"){
                    cropper.scale(flipData["horizontal"],1);
                    flip = false;
                }else{
                    cropper.scale(flipData["horizontal"],-1);
                    flip = true;
                }
                flipData["vertical"] = flip?-1:1;
                $(this).attr('data-flipped',flip);
                break;

        }
    }
});



$(function(){
    pashayev.stopLoader();
    $('.form-check-input-styled').uniform();
});
