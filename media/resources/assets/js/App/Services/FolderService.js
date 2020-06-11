import {MediaList} from '../Views/MediaList';
import {MediaConfig} from '../Config/MediaConfig';
import {MediaService} from './MediaService';
import {MessageService} from '../Services/MessageService';
import {Helpers} from '../Helpers/Helpers';

export class FolderService {
    constructor() {
        this.MediaList = new MediaList();
        this.MediaService = new MediaService();

        $('body').on('shown.bs.modal', '#modal_add_folder', function () {
            $(this).find('.form-add-folder input[type=text]').focus();
        });
    }

    create(folderName) {
        let _self = this;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: RV_MEDIA_URL.create_folder,
            type: 'POST',
            data: {
                parent_id: Helpers.getRequestParams().folder_id,
                name: folderName
            },
            dataType: 'json',
            beforeSend: function () {
                Helpers.showAjaxLoading();
            },
            success: function (res) {
                if (res.error) {
                    MessageService.showMessage('error', res.message, RV_MEDIA_CONFIG.translations.message.error_header);
                } else {
                    MessageService.showMessage('success', res.message, RV_MEDIA_CONFIG.translations.message.success_header);
                    Helpers.resetPagination();
                    _self.MediaService.getMedia(true);
                    FolderService.closeModal();
                }
            },
            complete: function () {
                Helpers.hideAjaxLoading();
            },
            error: function (data) {
                MessageService.handleError(data);
            }
        });
    }

    changeFolder(folderId) {
        MediaConfig.request_params.folder_id = folderId;
        Helpers.storeConfig();
        this.MediaService.getMedia(true);
    }

    static closeModal() {
        $(document).find('#modal_add_folder').modal('hide');
    }
}
