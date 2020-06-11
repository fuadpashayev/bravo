!function (e) {
    var t = {};

    function a(i) {
        if (t[i]) return t[i].exports;
        var n = t[i] = {i: i, l: !1, exports: {}};
        return e[i].call(n.exports, n, n.exports, a), n.l = !0, n.exports
    }

    a.m = e, a.c = t, a.d = function (e, t, i) {
        a.o(e, t) || Object.defineProperty(e, t, {configurable: !1, enumerable: !0, get: i})
    }, a.n = function (e) {
        var t = e && e.__esModule ? function () {
            return e.default
        } : function () {
            return e
        };
        return a.d(t, "a", t), t
    }, a.o = function (e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }, a.p = "", a(a.s = 3)
}([function (e, t, a) {
    "use strict";
    a.d(t, "a", function () {
        return r
    });
    var i = a(1), n = function () {
        function e(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }

        return function (t, a, i) {
            return a && e(t.prototype, a), i && e(t, i), t
        }
    }();
    var r = function () {
        function e() {
            !function (e, t) {
                if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
            }(this, e)
        }

        return n(e, null, [{
            key: "getUrlParam", value: function (e) {
                var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : null;
                t || (t = window.location.search);
                var a = new RegExp("(?:[?&]|&)" + e + "=([^&]+)", "i"), i = t.match(a);
                return i && i.length > 1 ? i[1] : null
            }
        }, {
            key: "asset", value: function (e) {
                if ("//" === e.substring(0, 2) || "http://" === e.substring(0, 7) || "https://" === e.substring(0, 8)) return e;
                var t = "/" !== RV_MEDIA_URL.base_url.substr(-1, 1) ? RV_MEDIA_URL.base_url + "/" : RV_MEDIA_URL.base_url;
                return "/" === e.substring(0, 1) ? t + e.substring(1) : t + e
            }
        }, {
            key: "showAjaxLoading", value: function () {
                (arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : $(".rv-media-main")).addClass("on-loading").append($("#rv_media_loading").html())
            }
        }, {
            key: "hideAjaxLoading", value: function () {
                (arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : $(".rv-media-main")).removeClass("on-loading").find(".loading-wrapper").remove()
            }
        }, {
            key: "isOnAjaxLoading", value: function () {
                return (arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : $(".rv-media-items")).hasClass("on-loading")
            }
        }, {
            key: "jsonEncode", value: function (e) {
                return void 0 === e && (e = null), JSON.stringify(e)
            }
        }, {
            key: "jsonDecode", value: function (e, t) {
                if (!e) return t;
                if ("string" == typeof e) {
                    var a = void 0;
                    try {
                        a = $.parseJSON(e)
                    } catch (e) {
                        a = t
                    }
                    return a
                }
                return e
            }
        }, {
            key: "getRequestParams", value: function () {
                return window.rvMedia.options && "modal" === window.rvMedia.options.open_in ? $.extend(!0, i.a.request_params, window.rvMedia.options || {}) : i.a.request_params
            }
        }, {
            key: "setSelectedFile", value: function (e) {
                void 0 !== window.rvMedia.options ? window.rvMedia.options.selected_file_id = e : i.a.request_params.selected_file_id = e
            }
        }, {
            key: "getConfigs", value: function () {
                return i.a
            }
        }, {
            key: "storeConfig", value: function () {
                localStorage.setItem("MediaConfig", e.jsonEncode(i.a))
            }
        }, {
            key: "storeRecentItems", value: function () {
                localStorage.setItem("RecentItems", e.jsonEncode(i.b))
            }
        }, {
            key: "addToRecent", value: function (e) {
                e instanceof Array ? _.each(e, function (e) {
                    i.b.push(e)
                }) : i.b.push(e)
            }
        }, {
            key: "getItems", value: function () {
                var e = [];
                return $(".js-media-list-title").each(function () {
                    var t = $(this), a = t.data() || {};
                    a.index_key = t.index(), e.push(a)
                }), e
            }
        }, {
            key: "getSelectedItems", value: function () {
                var e = [];
                return $(".js-media-list-title input[type=checkbox]:checked").each(function () {
                    var t = $(this).closest(".js-media-list-title"), a = t.data() || {};
                    a.index_key = t.index(), e.push(a)
                }), e
            }
        }, {
            key: "getSelectedFiles", value: function () {
                var e = [];
                return $(".js-media-list-title[data-context=file] input[type=checkbox]:checked").each(function () {
                    var t = $(this).closest(".js-media-list-title"), a = t.data() || {};
                    a.index_key = t.index(), e.push(a)
                }), e
            }
        }, {
            key: "getSelectedFolder", value: function () {
                var e = [];
                return $(".js-media-list-title[data-context=folder] input[type=checkbox]:checked").each(function () {
                    var t = $(this).closest(".js-media-list-title"), a = t.data() || {};
                    a.index_key = t.index(), e.push(a)
                }), e
            }
        }, {
            key: "isUseInModal", value: function () {
                return "select-files" === e.getUrlParam("media-action") || window.rvMedia && window.rvMedia.options && "modal" === window.rvMedia.options.open_in
            }
        }, {
            key: "resetPagination", value: function () {
                RV_MEDIA_CONFIG.pagination = {paged: 1, posts_per_page: 40, in_process_get_media: !1, has_more: !0}
            }
        }]), e
    }()
}, function (e, t, a) {
    "use strict";
    a.d(t, "a", function () {
        return i
    }), a.d(t, "b", function () {
        return r
    });
    var i = $.parseJSON(localStorage.getItem("MediaConfig")) || {}, n = {
        app_key: "483a0xyzytz1242c0d520426e8ba366c530c3d9dabc",
        request_params: {
            view_type: "tiles",
            filter: "everything",
            view_in: "all_media",
            search: "",
            sort_by: "created_at-desc",
            folder_id: 0
        },
        hide_details_pane: !1,
        icons: {folder: "fa fa-folder-o"},
        actions_list: {
            basic: [{
                icon: "fa fa-eye",
                name: "Preview",
                action: "preview",
                order: 0,
                class: "rv-action-preview"
            }],
            file: [{
                icon: "fa fa-link",
                name: "Copy link",
                action: "copy_link",
                order: 0,
                class: "rv-action-copy-link"
            }, {
                icon: "fa fa-pencil",
                name: "Rename",
                action: "rename",
                order: 1,
                class: "rv-action-rename"
            }, {icon: "fa fa-copy", name: "Make a copy", action: "make_copy", order: 2, class: "rv-action-make-copy"}],
            user: [{
                icon: "fa fa-star",
                name: "Favorite",
                action: "favorite",
                order: 2,
                class: "rv-action-favorite"
            }, {
                icon: "fa fa-star-o",
                name: "Remove favorite",
                action: "remove_favorite",
                order: 3,
                class: "rv-action-favorite"
            }],
            other: [{
                icon: "fa fa-download",
                name: "Download",
                action: "download",
                order: 0,
                class: "rv-action-download"
            }, {
                icon: "fa fa-trash",
                name: "Move to trash",
                action: "trash",
                order: 1,
                class: "rv-action-trash"
            }, {
                icon: "fa fa-eraser",
                name: "Delete permanently",
                action: "delete",
                order: 2,
                class: "rv-action-delete"
            }, {icon: "fa fa-undo", name: "Restore", action: "restore", order: 3, class: "rv-action-restore"}]
        },
        denied_download: ["youtube"]
    };
    i.app_key && i.app_key === n.app_key || (i = n);
    var r = $.parseJSON(localStorage.getItem("RecentItems")) || []
}, function (e, t, a) {
    "use strict";
    Object.defineProperty(t, "__esModule", {value: !0}), a.d(t, "EditorService", function () {
        return s
    });
    var i = a(0), n = a(1), r = function () {
        function e(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }

        return function (t, a, i) {
            return a && e(t.prototype, a), i && e(t, i), t
        }
    }();

    function o(e, t) {
        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
    }

    var s = function () {
        function e() {
            o(this, e)
        }

        return r(e, null, [{
            key: "editorSelectFile", value: function (e) {
                var t = i.a.getUrlParam("CKEditor") || i.a.getUrlParam("CKEditorFuncNum");
                if (window.opener && t) {
                    var a = _.first(e);
                    window.opener.CKEDITOR.tools.callFunction(i.a.getUrlParam("CKEditorFuncNum"), a.url), window.opener && window.close()
                }
            }
        }]), e
    }(), l = function e(t, a) {
        o(this, e), window.rvMedia = window.rvMedia || {};
        var r = $("body");
        a = $.extend(!0, {
            multiple: !0, type: "*", onSelectFiles: function (e, t) {
            }
        }, a);
        var s = function (e) {
            e.preventDefault();
            var t = $(this);
            $("#rv_media_modal").modal(), window.rvMedia.options = a, window.rvMedia.options.open_in = "modal", window.rvMedia.$el = t, n.a.request_params.filter = "everything", i.a.storeConfig();
            var r = window.rvMedia.$el.data("rv-media");
            void 0 !== r && r.length > 0 && (r = r[0], window.rvMedia.options = $.extend(!0, window.rvMedia.options, r || {}), void 0 !== r.selected_file_id ? window.rvMedia.options.is_popup = !0 : void 0 !== window.rvMedia.options.is_popup && (window.rvMedia.options.is_popup = void 0)), 0 === $("#rv_media_body .rv-media-container").length ? $("#rv_media_body").load(RV_MEDIA_URL.popup, function (e) {
                e.error && alert(e.message), $("#rv_media_body").removeClass("media-modal-loading").closest(".modal-content").removeClass("bb-loading"), $(document).find(".rv-media-container .js-change-action[data-type=refresh]").trigger("click")
            }) : $(document).find(".rv-media-container .js-change-action[data-type=refresh]").trigger("click")
        };
        "string" == typeof t ? r.off("click", t).on("click", t, s) : t.off("click").on("click", s)
    };
    window.RvMediaStandAlone = l, $(".js-insert-to-editor").off("click").on("click", function (e) {
        e.preventDefault();
        var t = i.a.getSelectedFiles();
        window.rvMedia.selectedImageUrl=t[0].url;
        window.opener.getSelectedImage(t[0].url, t);
        window.close();
        _.size(t) > 0 && s.editorSelectFile(t)
    }), $.fn.rvMedia = function (e) {
        var t = $(this);
        n.a.request_params.filter = "everything", "trash" === n.a.request_params.view_in ? $(document).find(".js-insert-to-editor").prop("disabled", !0) : $(document).find(".js-insert-to-editor").prop("disabled", !1), i.a.storeConfig(), new l(t, e)
    }
}, function (e, t, a) {
    a(4), e.exports = a(5)
}, function (e, t, a) {
    "use strict";
    Object.defineProperty(t, "__esModule", {value: !0});
    var i = a(1), n = a(0), r = function () {
        function e(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }

        return function (t, a, i) {
            return a && e(t.prototype, a), i && e(t, i), t
        }
    }();
    var o = function () {
        function e() {
            !function (e, t) {
                if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
            }(this, e)
        }

        return r(e, null, [{
            key: "showMessage", value: function (e, t, a) {
                toastr.options = {
                    closeButton: !0,
                    progressBar: !0,
                    positionClass: "toast-bottom-right",
                    onclick: null,
                    showDuration: 1e3,
                    hideDuration: 1e3,
                    timeOut: 1e4,
                    extendedTimeOut: 1e3,
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut"
                }, toastr[e](t, a)
            }
        }, {
            key: "handleError", value: function (t) {
                void 0 !== t.responseJSON ? void 0 !== t.responseJSON.message ? e.showMessage("error", t.responseJSON.message, pashayev.translate('media.message_error_header')) : $.each(t.responseJSON, function (t, a) {
                    $.each(a, function (t, a) {
                        e.showMessage("error", a, pashayev.translate('media.message_error_header'))
                    })
                }) : e.showMessage("error", t.statusText, pashayev.translate('media.message_error_header'))
            }
        }]), e
    }(), s = function () {
        function e(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }

        return function (t, a, i) {
            return a && e(t.prototype, a), i && e(t, i), t
        }
    }();
    var l = function () {
        function e() {
            !function (e, t) {
                if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
            }(this, e)
        }

        return s(e, null, [{
            key: "handleDropdown", value: function () {
                var t = _.size(n.a.getSelectedItems());
                e.renderActions(), t > 0 ? $(".rv-dropdown-actions").removeClass("disabled") : $(".rv-dropdown-actions").addClass("disabled")
            }
        }, {
            key: "handlePreview", value: function () {
                var e = [];
                _.each(n.a.getSelectedFiles(), function (t) {
                    _.includes(["image", "youtube", "pdf", "text", "video"], t.type) && (e.push({src: t.url}), i.b.push(t.id))
                }), _.size(e) > 0 ? ($.fancybox.open(e), n.a.storeRecentItems()) : this.handleGlobalAction("download")
            }
        }, {
            key: "handleCopyLink", value: function () {
                var e = "";
                _.each(n.a.getSelectedFiles(), function (t) {
                    _.isEmpty(e) || (e += "\n"), e += t.full_url
                });
                var t = $(".js-rv-clipboard-temp");
                t.data("clipboard-text", e), new Clipboard(".js-rv-clipboard-temp", {
                    text: function () {
                        return e
                    }
                }), o.showMessage("success", pashayev.translate('media.clipboard_success'), pashayev.translate('media.message_success_header')), t.trigger("click")
            }
        }, {
            key: "handleGlobalAction", value: function (t, a) {
                var i = [];
                switch (_.each(n.a.getSelectedItems(), function (e) {
                    i.push({is_folder: e.is_folder, id: e.id, full_url: e.full_url})
                }), t) {
                    case"rename":
                        $("#modal_rename_items").modal("show").find("form.rv-form").data("action", t);
                        break;
                    case"copy_link":
                        e.handleCopyLink();
                        break;
                    case"preview":
                        e.handlePreview();
                        break;
                    case"trash":
                        $("#modal_trash_items").modal("show").find("form.rv-form").data("action", t);
                        break;
                    case"delete":
                        $("#modal_delete_items").modal("show").find("form.rv-form").data("action", t);
                        break;
                    case"empty_trash":
                        $("#modal_empty_trash").modal("show").find("form.rv-form").data("action", t);
                        break;
                    case"download":
                        var r = RV_MEDIA_URL.download, s = 0;
                        _.each(n.a.getSelectedItems(), function (e) {
                            _.includes(n.a.getConfigs().denied_download, e.mime_type) || (r += (0 === s ? "?" : "&") + "selected[" + s + "][is_folder]=" + e.is_folder + "&selected[" + s + "][id]=" + e.id, s++)
                        }), r !== RV_MEDIA_URL.download ? window.open(r, "_blank") : o.showMessage("error", pashayev.translate('media.download_error'), pashayev.translate('media.message_error_header'));
                        break;
                    default:
                        e.processAction({selected: i, action: t}, a)
                }
            }
        }, {
            key: "processAction", value: function (e) {
                var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : null;
                $.ajax({
                    url: RV_MEDIA_URL.global_actions,
                    type: "POST",
                    data: e,
                    dataType: "json",
                    beforeSend: function () {
                        n.a.showAjaxLoading()
                    },
                    success: function (e) {
                        n.a.resetPagination(), e.error ? o.showMessage("error", e.message, pashayev.translate('media.message_error_header')) : o.showMessage("success", e.message, pashayev.translate('media.message_success_header')), t && t(e)
                    },
                    complete: function () {
                        n.a.hideAjaxLoading()
                    },
                    error: function (e) {
                        o.handleError(e)
                    }
                })
            }
        }, {
            key: "renderRenameItems", value: function () {
                var e = $("#rv_media_rename_item").html(), t = $("#modal_rename_items .rename-items").empty();
                _.each(n.a.getSelectedItems(), function (a) {
                    var i = e.replace(/__icon__/gi, a.icon || "fa fa-file-o").replace(/__placeholder__/gi, "Input file name").replace(/__value__/gi, a.name),
                        n = $(i);
                    n.data("id", a.id), n.data("is_folder", a.is_folder), n.data("name", a.name), t.append(n)
                })
            }
        }, {
            key: "renderActions", value: function () {
                var e = n.a.getSelectedFolder().length > 0, t = $("#rv_action_item").html(), a = 0,
                    i = $(".rv-dropdown-actions .dropdown-menu");
                i.empty();
                var r = $.extend({}, !0, n.a.getConfigs().actions_list);
                e && (r.basic = _.reject(r.basic, function (e) {
                    return "preview" === e.action
                }), r.file = _.reject(r.file, function (e) {
                    return "copy_link" === e.action
                }), _.includes(RV_MEDIA_CONFIG.permissions, "folders.create") || (r.file = _.reject(r.file, function (e) {
                    return "make_copy" === e.action
                })), _.includes(RV_MEDIA_CONFIG.permissions, "folders.edit") || (r.file = _.reject(r.file, function (e) {
                    return _.includes(["rename"], e.action)
                }), r.user = _.reject(r.user, function (e) {
                    return _.includes(["rename"], e.action)
                })), _.includes(RV_MEDIA_CONFIG.permissions, "folders.trash") || (r.other = _.reject(r.other, function (e) {
                    return _.includes(["trash", "restore"], e.action)
                })), _.includes(RV_MEDIA_CONFIG.permissions, "folders.delete") || (r.other = _.reject(r.other, function (e) {
                    return _.includes(["delete"], e.action)
                })), _.includes(RV_MEDIA_CONFIG.permissions, "folders.favorite") || (r.other = _.reject(r.other, function (e) {
                    return _.includes(["favorite", "remove_favorite"], e.action)
                })));
                var o = n.a.getSelectedFiles(), s = !1;
                _.each(o, function (e) {
                    _.includes(["image", "youtube", "pdf", "text", "video"], e.type) && (s = !0)
                }), s || (r.basic = _.reject(r.basic, function (e) {
                    return "preview" === e.action
                })), o.length > 0 && (_.includes(RV_MEDIA_CONFIG.permissions, "files.create") || (r.file = _.reject(r.file, function (e) {
                    return "make_copy" === e.action
                })), _.includes(RV_MEDIA_CONFIG.permissions, "files.edit") || (r.file = _.reject(r.file, function (e) {
                    return _.includes(["rename"], e.action)
                })), _.includes(RV_MEDIA_CONFIG.permissions, "files.trash") || (r.other = _.reject(r.other, function (e) {
                    return _.includes(["trash", "restore"], e.action)
                })), _.includes(RV_MEDIA_CONFIG.permissions, "files.delete") || (r.other = _.reject(r.other, function (e) {
                    return _.includes(["delete"], e.action)
                })), _.includes(RV_MEDIA_CONFIG.permissions, "files.favorite") || (r.other = _.reject(r.other, function (e) {
                    return _.includes(["favorite", "remove_favorite"], e.action)
                }))), _.each(r, function (e, r) {
                    _.each(e, function (e, o) {
                        var s = !1;
                        switch (n.a.getRequestParams().view_in) {
                            case"all_media":
                                _.includes(["remove_favorite", "delete", "restore"], e.action) && (s = !0);
                                break;
                            case"recent":
                                _.includes(["remove_favorite", "delete", "restore", "make_copy"], e.action) && (s = !0);
                                break;
                            case"favorites":
                                _.includes(["favorite", "delete", "restore", "make_copy"], e.action) && (s = !0);
                                break;
                            case"trash":
                                _.includes(["preview", "delete", "restore", "rename", "download"], e.action) || (s = !0)
                        }
                        if (!s) {
                            var l = t.replace(/__action__/gi, e.action || "").replace(/__icon__/gi, e.icon || "").replace(/__name__/gi, pashayev.translate(`media.${r}_${e.action}`) || e.name);
                            !o && a && (l = '<li role="separator" class="divider"></li>' + l), i.append(l)
                        }
                    }), e.length > 0 && a++
                })
            }
        }]), e
    }(), d = function () {
        function e(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }

        return function (t, a, i) {
            return a && e(t.prototype, a), i && e(t, i), t
        }
    }();
    var c = function () {
        function e() {
            !function (e, t) {
                if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
            }(this, e)
        }

        return d(e, null, [{
            key: "initContext", value: function () {
                jQuery().contextMenu && ($.contextMenu({
                    selector: '.js-context-menu[data-context="file"]',
                    build: function (t, a) {
                        return {items: e._fileContextMenu()}
                    }
                }), $.contextMenu({
                    selector: '.js-context-menu[data-context="folder"]', build: function (t, a) {
                        return {items: e._folderContextMenu()}
                    }
                }))
            }
        }, {
            key: "_fileContextMenu", value: function () {
                var e = {
                    preview: {
                        name: "Preview", icon: function (e, t, a, i) {
                            return t.html('<i class="fa fa-eye" aria-hidden="true"></i> ' + i.name), "context-menu-icon-updated"
                        }, callback: function (e, t) {
                            l.handlePreview()
                        }
                    }
                };
                _.each(n.a.getConfigs().actions_list, function (t, a) {
                    _.each(t, function (t) {
                        e[t.action] = {
                            name: t.name, icon: function (e, i, n, r) {
                                return i.html('<i class="' + t.icon + '" aria-hidden="true"></i> ' + (pashayev.translate(`media.${a}_${t.action}`) || r.name)), "context-menu-icon-updated"
                            }, callback: function (e, a) {
                                $('.js-files-action[data-action="' + t.action + '"]').trigger("click")
                            }
                        }
                    })
                });
                var t = [];
                switch (n.a.getRequestParams().view_in) {
                    case"all_media":
                        t = ["remove_favorite", "delete", "restore"];
                        break;
                    case"recent":
                        t = ["remove_favorite", "delete", "restore", "make_copy"];
                        break;
                    case"favorites":
                        t = ["favorite", "delete", "restore", "make_copy"];
                        break;
                    case"trash":
                        e = {
                            preview: e.preview,
                            rename: e.rename,
                            download: e.download,
                            delete: e.delete,
                            restore: e.restore
                        }
                }
                _.each(t, function (t) {
                    e[t] = void 0
                }), n.a.getSelectedFolder().length > 0 && (e.preview = void 0, e.copy_link = void 0, _.includes(RV_MEDIA_CONFIG.permissions, "folders.create") || (e.make_copy = void 0), _.includes(RV_MEDIA_CONFIG.permissions, "folders.edit") || (e.rename = void 0), _.includes(RV_MEDIA_CONFIG.permissions, "folders.trash") || (e.trash = void 0, e.restore = void 0), _.includes(RV_MEDIA_CONFIG.permissions, "folders.delete") || (e.delete = void 0), _.includes(RV_MEDIA_CONFIG.permissions, "folders.favorite") || (e.favorite = void 0, e.remove_favorite = void 0));
                var a = n.a.getSelectedFiles();
                a.length > 0 && (_.includes(RV_MEDIA_CONFIG.permissions, "files.create") || (e.make_copy = void 0), _.includes(RV_MEDIA_CONFIG.permissions, "files.edit") || (e.rename = void 0), _.includes(RV_MEDIA_CONFIG.permissions, "files.trash") || (e.trash = void 0, e.restore = void 0), _.includes(RV_MEDIA_CONFIG.permissions, "files.delete") || (e.delete = void 0), _.includes(RV_MEDIA_CONFIG.permissions, "files.favorite") || (e.favorite = void 0, e.remove_favorite = void 0));
                var i = !1;
                return _.each(a, function (e) {
                    _.includes(["image", "youtube", "pdf", "text", "video"], e.type) && (i = !0)
                }), i || (e.preview = void 0), e
            }
        }, {
            key: "_folderContextMenu", value: function () {
                var t = e._fileContextMenu();
                return t.preview = void 0, t.copy_link = void 0, t
            }
        }, {
            key: "destroyContext", value: function () {
                jQuery().contextMenu && $.contextMenu("destroy")
            }
        }]), e
    }(), u = function () {
        function e(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }

        return function (t, a, i) {
            return a && e(t.prototype, a), i && e(t, i), t
        }
    }();
    var f = function () {
        function e() {
            !function (e, t) {
                if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
            }(this, e), this.group = {}, this.group.list = $("#rv_media_items_list").html(), this.group.tiles = $("#rv_media_items_tiles").html(), this.item = {}, this.item.list = $("#rv_media_items_list_element").html(), this.item.tiles = $("#rv_media_items_tiles_element").html(), this.$groupContainer = $(".rv-media-items")
        }

        return u(e, [{
            key: "renderData", value: function (e) {
                var t = arguments.length > 1 && void 0 !== arguments[1] && arguments[1],
                    a = arguments.length > 2 && void 0 !== arguments[2] && arguments[2], i = this, r = n.a.getConfigs(),
                    o = i.group[n.a.getRequestParams().view_type], s = n.a.getRequestParams().view_in;
                _.includes(["all_media", "public", "trash", "favorites", "recent"], s) || (s = "all_media"), o = o.replace(/__noItemIcon__/gi, pashayev.translate(`media.${s}_icon}`) || "").replace(/__noItemTitle__/gi, pashayev.translate(`media.${s}_title`) || "").replace(/__noItemMessage__/gi, pashayev.translate(`media.${s}_message`) || "");
                var d = $(o), c = d.find("ul");
                a && this.$groupContainer.find(".rv-media-grid ul").length > 0 && (c = this.$groupContainer.find(".rv-media-grid ul")), _.size(e.folders) > 0 || _.size(e.files) > 0 || a ? $(".rv-media-items").addClass("has-items") : $(".rv-media-items").removeClass("has-items"), _.forEach(e.folders, function (e, t) {
                    var a = i.item[n.a.getRequestParams().view_type];
                    a = a.replace(/__type__/gi, "folder").replace(/__id__/gi, e.id).replace(/__name__/gi, e.name || "").replace(/__size__/gi, "").replace(/__date__/gi, e.created_at || "").replace(/__thumb__/gi, '<i class="fa fa-folder-o"></i>');
                    var o = $(a);
                    _.forEach(e, function (e, t) {
                        o.data(t, e)
                    }), o.data("is_folder", !0), o.data("icon", r.icons.folder), c.append(o)
                }), _.forEach(e.files, function (e) {
                    var t = i.item[n.a.getRequestParams().view_type];
                    if (t = t.replace(/__type__/gi, "file").replace(/__id__/gi, e.id).replace(/__name__/gi, e.name || "").replace(/__size__/gi, e.size || "").replace(/__date__/gi, e.created_at || ""), "list" === n.a.getRequestParams().view_type) t = t.replace(/__thumb__/gi, '<i class="' + e.icon + '"></i>'); else switch (e.mime_type) {
                        case"youtube":
                            t = t.replace(/__thumb__/gi, '<img src="' + e.options.thumb + '" alt="' + e.name + '">');
                            break;
                        default:
                            t = t.replace(/__thumb__/gi, e.thumb ? '<img src="' + e.thumb + '" alt="' + e.name + '">' : '<i class="' + e.icon + '"></i>')
                    }
                    var a = $(t);
                    a.data("is_folder", !1), _.forEach(e, function (e, t) {
                        a.data(t, e)
                    }), c.append(a)
                }), !1 !== t && i.$groupContainer.empty(), a && this.$groupContainer.find(".rv-media-grid ul").length > 0 || i.$groupContainer.append(d), i.$groupContainer.find(".loading-wrapper").remove(), l.handleDropdown(), $(".js-media-list-title[data-id=" + e.selected_file_id + "]").trigger("click")
            }
        }]), e
    }(), p = function () {
        function e(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }

        return function (t, a, i) {
            return a && e(t.prototype, a), i && e(t, i), t
        }
    }();
    var m = function () {
        function e() {
            !function (e, t) {
                if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
            }(this, e), this.$detailsWrapper = $(".rv-media-main .rv-media-details"), this.descriptionItemTemplate = '<div class="rv-media-name"><p>__title__</p>__url__</div>', this.onlyFields = ["name", "full_url", "size", "mime_type", "created_at", "updated_at", "nothing_selected"], this.externalTypes = ["youtube", "vimeo", "metacafe", "dailymotion", "vine", "instagram"]
        }

        return p(e, [{
            key: "renderData", value: function (e) {
                var t = this,
                    a = "image" === e.type ? '<img src="' + e.full_url + '" alt="' + e.name + '">' : "youtube" === e.mime_type ? '<img src="' + e.options.thumb + '" alt="' + e.name + '">' : '<i class="' + e.icon + '"></i>',
                    i = "", r = !1;
                if (_.forEach(e, function (a, o) {
                    _.includes(t.onlyFields, o) && (!_.includes(t.externalTypes, e.type) || _.includes(t.externalTypes, e.type) && !_.includes(["size", "mime_type"], o)) && (i += t.descriptionItemTemplate.replace(/__title__/gi, pashayev.translate('media.'+o)).replace(/__url__/gi, a ? "full_url" === o ? '<div class="input-group"><input id="file_details_url" type="text" value="' + a + '" class="form-control"><span class="input-group-btn"><button class="btn btn-default js-btn-copy-to-clipboard" type="button" data-clipboard-target="#file_details_url" title="Copied"><img class="clippy" src="' + n.a.asset("/vendor/media/images/clippy.svg") + '" width="13" alt="Copy to clipboard"></button></span></div>' : '<span title="' + a + '">' + a + "</span>" : ""), "full_url" === o && (r = !0))
                }), t.$detailsWrapper.find(".rv-media-thumbnail").html(a), t.$detailsWrapper.find(".rv-media-description").html(i), r) {
                    new Clipboard(".js-btn-copy-to-clipboard");
                    $(".js-btn-copy-to-clipboard").tooltip().on("mouseenter", function () {
                        $(this).tooltip("hide")
                    }).on("mouseleave", function () {
                        $(this).tooltip("hide")
                    })
                }
            }
        }]), e
    }(), v = function () {
        function e(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }

        return function (t, a, i) {
            return a && e(t.prototype, a), i && e(t, i), t
        }
    }();
    var h = function () {
        function e() {
            !function (e, t) {
                if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
            }(this, e), this.MediaList = new f, this.MediaDetails = new m, this.breadcrumbTemplate = $("#rv_media_breadcrumb_item").html()
        }

        return v(e, [{
            key: "getMedia", value: function () {
                var t = arguments.length > 0 && void 0 !== arguments[0] && arguments[0],
                    a = arguments.length > 1 && void 0 !== arguments[1] && arguments[1],
                    r = arguments.length > 2 && void 0 !== arguments[2] && arguments[2];
                if (void 0 !== RV_MEDIA_CONFIG.pagination) {
                    if (RV_MEDIA_CONFIG.pagination.in_process_get_media) return;
                    RV_MEDIA_CONFIG.pagination.in_process_get_media = !0
                }
                var s = this;
                s.getFileDetails({icon: "fa fa-picture-o", nothing_selected: ""});
                var d = n.a.getRequestParams();
                "recent" === d.view_in && (d.recent_items = i.b), d.is_popup = !0 === a || void 0, d.onSelectFiles = void 0, void 0 !== d.search && "" != d.search && void 0 !== d.selected_file_id && (d.selected_file_id = void 0), d.load_more_file = r, void 0 !== RV_MEDIA_CONFIG.pagination && (d.paged = RV_MEDIA_CONFIG.pagination.paged, d.posts_per_page = RV_MEDIA_CONFIG.pagination.posts_per_page), $.ajax({
                    url: RV_MEDIA_URL.get_media,
                    type: "GET",
                    data: d,
                    dataType: "json",
                    beforeSend: function () {
                        n.a.showAjaxLoading()
                    },
                    success: function (a) {
                        s.MediaList.renderData(a.data, t, r), s.fetchQuota(), s.renderBreadcrumbs(a.data.breadcrumbs), e.refreshFilter(), l.renderActions(), void 0 !== RV_MEDIA_CONFIG.pagination && (void 0 !== RV_MEDIA_CONFIG.pagination.paged && (RV_MEDIA_CONFIG.pagination.paged += 1), void 0 !== RV_MEDIA_CONFIG.pagination.in_process_get_media && (RV_MEDIA_CONFIG.pagination.in_process_get_media = !1), void 0 !== RV_MEDIA_CONFIG.pagination.posts_per_page && a.data.files.length < RV_MEDIA_CONFIG.pagination.posts_per_page && void 0 !== RV_MEDIA_CONFIG.pagination.has_more && (RV_MEDIA_CONFIG.pagination.has_more = !1))
                    },
                    complete: function (e) {
                        n.a.hideAjaxLoading()
                    },
                    error: function (e) {
                        o.handleError(e)
                    }
                })
            }
        }, {
            key: "getFileDetails", value: function (e) {
                this.MediaDetails.renderData(e)
            }
        }, {
            key: "fetchQuota", value: function () {
                $.ajax({
                    url: RV_MEDIA_URL.get_quota, type: "GET", dataType: "json", beforeSend: function () {
                    }, success: function (e) {
                        var t = e.data;
                        $(".rv-media-aside-bottom .used-analytics span").html(t.used + " / " + t.quota), $(".rv-media-aside-bottom .progress-bar").css({width: t.percent + "%"})
                    }, error: function (e) {
                        o.handleError(e)
                    }
                })
            }
        }, {
            key: "renderBreadcrumbs", value: function (e) {
                var t = this, a = $(".rv-media-breadcrumb .breadcrumb");
                a.find("li").remove(), _.each(e, function (e, i) {
                    var n = t.breadcrumbTemplate;
                    n = n.replace(/__name__/gi, e.name || "").replace(/__icon__/gi, e.icon ? '<i class="' + e.icon + '"></i>' : "").replace(/__folderId__/gi, e.id || 0), a.append($(n))
                }), $(".rv-media-container").attr("data-breadcrumb-count", _.size(e))
            }
        }], [{
            key: "refreshFilter", value: function () {
                var e = $(".rv-media-container"), t = n.a.getRequestParams().view_in;
                "all_media" !== t && 0 == n.a.getRequestParams().folder_id ? ($('.rv-media-actions .btn:not([data-type="refresh"]):not(label)').addClass("disabled"), e.attr("data-allow-upload", "false")) : ($('.rv-media-actions .btn:not([data-type="refresh"]):not(label)').removeClass("disabled"), e.attr("data-allow-upload", "true")), $(".rv-media-actions .btn.js-rv-media-change-filter-group").removeClass("disabled");
                var a = $('.rv-media-actions .btn[data-action="empty_trash"]');
                "trash" === t ? (a.removeClass("hidden").removeClass("disabled"), _.size(n.a.getItems()) || a.addClass("hidden").addClass("disabled")) : a.addClass("hidden"), c.destroyContext(), c.initContext(), e.attr("data-view-in", t)
            }
        }]), e
    }(), g = function () {
        function e(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }

        return function (t, a, i) {
            return a && e(t.prototype, a), i && e(t, i), t
        }
    }();
    var y = function () {
        function e() {
            !function (e, t) {
                if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
            }(this, e), this.MediaList = new f, this.MediaService = new h, $("body").on("shown.bs.modal", "#modal_add_folder", function () {
                $(this).find(".form-add-folder input[type=text]").focus()
            })
        }

        return g(e, [{
            key: "create", value: function (t) {
                var a = this;
                $.ajaxSetup({headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")}}), $.ajax({
                    url: RV_MEDIA_URL.create_folder,
                    type: "POST",
                    data: {parent_id: n.a.getRequestParams().folder_id, name: t},
                    dataType: "json",
                    beforeSend: function () {
                        n.a.showAjaxLoading()
                    },
                    success: function (t) {
                        t.error ? o.showMessage("error", t.message, pashayev.translate('media.message_error_header')) : (o.showMessage("success", t.message, pashayev.translate('media.message_success_header')), n.a.resetPagination(), a.MediaService.getMedia(!0), e.closeModal())
                    },
                    complete: function () {
                        n.a.hideAjaxLoading()
                    },
                    error: function (e) {
                        o.handleError(e)
                    }
                })
            }
        }, {
            key: "changeFolder", value: function (e) {
                i.a.request_params.folder_id = e, n.a.storeConfig(), this.MediaService.getMedia(!0)
            }
        }], [{
            key: "closeModal", value: function () {
                $(document).find("#modal_add_folder").modal("hide")
            }
        }]), e
    }(), b = function () {
        function e(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }

        return function (t, a, i) {
            return a && e(t.prototype, a), i && e(t, i), t
        }
    }();
    var w = function () {
        function e() {
            !function (e, t) {
                if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
            }(this, e), this.$body = $("body"), this.dropZone = null, this.uploadUrl = RV_MEDIA_URL.upload_file, this.uploadProgressBox = $(".rv-upload-progress"), this.uploadProgressContainer = $(".rv-upload-progress .rv-upload-progress-table"), this.uploadProgressTemplate = $("#rv_media_upload_progress_item").html(), this.totalQueued = 1, this.MediaService = new h, this.totalError = 0
        }

        return b(e, [{
            key: "init", value: function () {
                _.includes(RV_MEDIA_CONFIG.permissions, "files.create") && $(".rv-media-items").length > 0 && this.setupDropZone(), this.handleEvents()
            }
        }, {
            key: "setupDropZone", value: function () {
                var e = this;
                e.dropZone = new Dropzone(document.querySelector(".rv-media-items"), {
                    url: e.uploadUrl,
                    thumbnailWidth: !1,
                    thumbnailHeight: !1,
                    parallelUploads: 1,
                    autoQueue: !0,
                    clickable: ".js-dropzone-upload",
                    previewTemplate: !1,
                    previewsContainer: !1,
                    uploadMultiple: !0,
                    sending: function (e, t, a) {
                        a.append("_token", $('meta[name="csrf-token"]').attr("content")), a.append("folder_id", n.a.getRequestParams().folder_id), a.append("view_in", n.a.getRequestParams().view_in)
                    }
                }), e.dropZone.on("addedfile", function (t) {
                    t.index = e.totalQueued, e.totalQueued++
                }), e.dropZone.on("sending", function (t) {
                    e.initProgress(t.name, t.size)
                }), e.dropZone.on("success", function (e) {
                }), e.dropZone.on("complete", function (t) {
                    e.changeProgressStatus(t)
                }), e.dropZone.on("queuecomplete", function () {
                    n.a.resetPagination(), e.MediaService.getMedia(!0), 0 === e.totalError && setTimeout(function () {
                        $(".rv-upload-progress .close-pane").trigger("click")
                    }, 5e3)
                })
            }
        }, {
            key: "handleEvents", value: function () {
                var e = this;
                e.$body.on("click", ".rv-upload-progress .close-pane", function (t) {
                    t.preventDefault(), $(".rv-upload-progress").addClass("hide-the-pane"), e.totalError = 0, setTimeout(function () {
                        $(".rv-upload-progress li").remove(), e.totalQueued = 1
                    }, 300)
                })
            }
        }, {
            key: "initProgress", value: function (t, a) {
                var i = this.uploadProgressTemplate.replace(/__fileName__/gi, t).replace(/__fileSize__/gi, e.formatFileSize(a)).replace(/__status__/gi, "warning").replace(/__message__/gi, "Uploading");
                this.uploadProgressContainer.append(i), this.uploadProgressBox.removeClass("hide-the-pane"), this.uploadProgressBox.find(".panel-body").animate({scrollTop: this.uploadProgressContainer.height()}, 150)
            }
        }, {
            key: "changeProgressStatus", value: function (e) {
                var t = this.uploadProgressContainer.find("li:nth-child(" + e.index + ")"), a = t.find(".label");
                a.removeClass("label-success label-danger label-warning");
                var i = n.a.jsonDecode(e.xhr.responseText || "", {});
                if (this.totalError = this.totalError + (!0 === i.error || "error" === e.status ? 1 : 0), a.addClass(!0 === i.error || "error" === e.status ? "label-danger" : "label-success"), a.html(!0 === i.error || "error" === e.status ? "Error" : "Uploaded"), "error" === e.status) if (422 === e.xhr.status) {
                    var r = "";
                    $.each(i, function (e, t) {
                        r += '<span class="text-danger">' + t + "</span><br>"
                    }), t.find(".file-error").html(r)
                } else 500 === e.xhr.status && t.find(".file-error").html('<span class="text-danger">' + e.xhr.statusText + "</span>"); else i.error ? t.find(".file-error").html('<span class="text-danger">' + i.message + "</span>") : (n.a.addToRecent(i.data.id), n.a.setSelectedFile(i.data.id))
            }
        }], [{
            key: "formatFileSize", value: function (e) {
                var t = arguments.length > 1 && void 0 !== arguments[1] && arguments[1] ? 1e3 : 1024;
                if (Math.abs(e) < t) return e + " B";
                var a = ["KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"], i = -1;
                do {
                    e /= t, ++i
                } while (Math.abs(e) >= t && i < a.length - 1);
                return e.toFixed(1) + " " + a[i]
            }
        }]), e
    }(), M = {api_key: "AIzaSyB4blGc1uTMWnHKe20kdJ6QtiWCyw8BNCI"}, k = function () {
        function e(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }

        return function (t, a, i) {
            return a && e(t.prototype, a), i && e(t, i), t
        }
    }();
    var I = function () {
        function e() {
            !function (e, t) {
                if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
            }(this, e), this.MediaService = new h, this.$body = $("body"), this.$modal = $("#modal_add_from_youtube");
            var t = this;
            this.setMessage(pashayev.translate(`media.youtube_original_msg`)), this.$modal.on("hidden.bs.modal", function () {
                t.setMessage(pashayev.translate(`media.youtube_original_msg`))
            }), this.$body.on("click", "#modal_add_from_youtube .rv-btn-add-youtube-url", function (e) {
                e.preventDefault(), t.checkYouTubeVideo($(this).closest("#modal_add_from_youtube").find(".rv-youtube-url"))
            })
        }

        return k(e, [{
            key: "setMessage", value: function (e) {
                this.$modal.find(".modal-notice").html(e)
            }
        }, {
            key: "checkYouTubeVideo", value: function (t) {
                var a = this;
                if (e.validateYouTubeLink(t.val()) && M.api_key) {
                    var i = e.getYouTubeId(t.val()), r = "https://www.googleapis.com/youtube/v3/videos?id=" + i,
                        s = a.$modal.find('.custom-checkbox input[type="checkbox"]').is(":checked");
                    s && (r = "https://www.googleapis.com/youtube/v3/playlistItems?playlistId=" + (i = e.getYoutubePlaylistId(t.val()))), $.ajax({
                        url: r + "&key=" + M.api_key + "&part=snippet",
                        type: "GET",
                        success: function (e) {
                            s ? (t.val(), a.$modal.modal("hide")) : function (e, t) {
                                $.ajax({
                                    url: RV_MEDIA_URL.add_external_service,
                                    type: "POST",
                                    dataType: "json",
                                    data: {
                                        type: "youtube",
                                        name: e.items[0].snippet.title,
                                        folder_id: n.a.getRequestParams().folder_id,
                                        url: t,
                                        options: {thumb: "https://img.youtube.com/vi/" + e.items[0].id + "/maxresdefault.jpg"}
                                    },
                                    success: function (e) {
                                        e.error ? o.showMessage("error", e.message, pashayev.translate('media.message_error_header')) : (o.showMessage("success", e.message, pashayev.translate('media.message_success_header')), a.MediaService.getMedia(!0))
                                    },
                                    error: function (e) {
                                        o.handleError(e)
                                    }
                                }), a.$modal.modal("hide")
                            }(e, t.val())
                        },
                        error: function (e) {
                            a.setMessage(pashayev.translate(`media.youtube_error_msg`))
                        }
                    })
                } else M.api_key ? a.setMessage(pashayev.translate(`media.youtube_invalid_url_msg`)) : a.setMessage(pashayev.translate(`media.youtube_no_api_key_msg`))
            }
        }], [{
            key: "validateYouTubeLink", value: function (e) {
                return !!e.match(/^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/) && RegExp.$1
            }
        }, {
            key: "getYouTubeId", value: function (e) {
                var t = e.match(/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/);
                return t && 11 === t[2].length ? t[2] : null
            }
        }, {
            key: "getYoutubePlaylistId", value: function (e) {
                var t = e.match(/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?list=|\&list=)([^#\&\?]*).*/);
                return t ? t[2] : null
            }
        }]), e
    }();
    var C = function e() {
        !function (e, t) {
            if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
        }(this, e), new I
    }, E = a(2), R = function () {
        function e(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }

        return function (t, a, i) {
            return a && e(t.prototype, a), i && e(t, i), t
        }
    }();
    var D = function () {
        function e() {
            !function (e, t) {
                if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
            }(this, e), this.MediaService = new h, this.UploadService = new w, this.FolderService = new y, new C, this.$body = $("body")
        }

        return R(e, [{
            key: "init", value: function () {
                n.a.resetPagination(), this.setupLayout(), this.handleMediaList(), this.changeViewType(), this.changeFilter(), this.search(), this.handleActions(), this.UploadService.init(), this.handleModals(), this.scrollGetMore()
            }
        }, {
            key: "setupLayout", value: function () {
                var e = $('.js-rv-media-change-filter[data-type="filter"][data-value="' + n.a.getRequestParams().filter + '"]');
                e.closest("li").addClass("active").closest(".dropdown").find(".js-rv-media-filter-current").html("(" + e.html() + ")");
                var t = $('.js-rv-media-change-filter[data-type="view_in"][data-value="' + n.a.getRequestParams().view_in + '"]');
                t.closest("li").addClass("active").closest(".dropdown").find(".js-rv-media-filter-current").html("(" + t.html() + ")"), n.a.isUseInModal() && $(".rv-media-footer").removeClass("hidden"), $('.js-rv-media-change-filter[data-type="sort_by"][data-value="' + n.a.getRequestParams().sort_by + '"]').closest("li").addClass("active");
                var a = $("#media_details_collapse");
                a.prop("checked", i.a.hide_details_pane || !1), setTimeout(function () {
                    $(".rv-media-details").removeClass("hidden")
                }, 300), a.on("change", function (e) {
                    e.preventDefault(), i.a.hide_details_pane = $(this).is(":checked"), n.a.storeConfig()
                }), $(document).on("click", "button[data-dismiss-modal]", function () {
                    var e = $(this).data("dismiss-modal");
                    $(e).modal("hide")
                })
            }
        }, {
            key: "handleMediaList", value: function () {
                var e = this, t = !1, a = !1, i = !1;
                $(document).on("keyup keydown", function (e) {
                    t = e.ctrlKey, a = e.metaKey, i = e.shiftKey
                }), e.$body.on("click", ".js-media-list-title", function (r) {
                    r.preventDefault();
                    var o = $(this);
                    if (i) {
                        var s = _.first(n.a.getSelectedItems());
                        if (s) {
                            var d = s.index_key, c = o.index();
                            $(".rv-media-items li").each(function (e) {
                                e > d && e <= c && $(this).find("input[type=checkbox]").prop("checked", !0)
                            })
                        }
                    } else t || a || o.closest(".rv-media-items").find("input[type=checkbox]").prop("checked", !1);
                    o.find("input[type=checkbox]").prop("checked", !0), l.handleDropdown(), e.MediaService.getFileDetails(o.data())
                }).on("dblclick", ".js-media-list-title", function (t) {
                    t.preventDefault();
                    var a = $(this).data();
                    if (!0 === a.is_folder) n.a.resetPagination(), e.FolderService.changeFolder(a.id); else if (n.a.isUseInModal()) {
                        if ("trash" !== n.a.getConfigs().request_params.view_in) {
                            var i = n.a.getSelectedFiles();
                            _.size(i) > 0 && E.EditorService.editorSelectFile(i)
                        }
                    } else l.handlePreview()
                }).on("dblclick", ".js-up-one-level", function (e) {
                    e.preventDefault();
                    var t = $(".rv-media-breadcrumb .breadcrumb li").length;
                    $(".rv-media-breadcrumb .breadcrumb li:nth-child(" + (t - 1) + ") a").trigger("click")
                }).on("contextmenu", ".js-context-menu", function (e) {
                    $(this).find("input[type=checkbox]").is(":checked") || $(this).trigger("click")
                }).on("click contextmenu", ".rv-media-items", function (t) {
                    _.size(t.target.closest(".js-context-menu")) || ($('.rv-media-items input[type="checkbox"]').prop("checked", !1), $(".rv-dropdown-actions").addClass("disabled"), e.MediaService.getFileDetails({
                        icon: "fa fa-picture-o",
                        nothing_selected: ""
                    }))
                })
            }
        }, {
            key: "changeViewType", value: function () {
                var e = this;
                e.$body.on("click", ".js-rv-media-change-view-type .btn", function (t) {
                    t.preventDefault();
                    var a = $(this);
                    a.hasClass("active") || (a.closest(".js-rv-media-change-view-type").find(".btn").removeClass("active"), a.addClass("active"), i.a.request_params.view_type = a.data("type"), "trash" === a.data("type") ? $(document).find(".js-insert-to-editor").prop("disabled", !0) : $(document).find(".js-insert-to-editor").prop("disabled", !1), n.a.storeConfig(), void 0 !== RV_MEDIA_CONFIG.pagination && void 0 !== RV_MEDIA_CONFIG.pagination.paged && (RV_MEDIA_CONFIG.pagination.paged = 1), e.MediaService.getMedia(!0, !1))
                }), $('.js-rv-media-change-view-type .btn[data-type="' + n.a.getRequestParams().view_type + '"]').trigger("click"), this.bindIntegrateModalEvents()
            }
        }, {
            key: "changeFilter", value: function () {
                var e = this;
                e.$body.on("click", ".js-rv-media-change-filter", function (t) {
                    if (t.preventDefault(), !n.a.isOnAjaxLoading()) {
                        var a = $(this), r = a.closest("ul"), o = a.data();
                        i.a.request_params[o.type] = o.value, "view_in" === o.type && (i.a.request_params.folder_id = 0, "trash" === o.value ? $(document).find(".js-insert-to-editor").prop("disabled", !0) : $(document).find(".js-insert-to-editor").prop("disabled", !1)), a.closest(".dropdown").find(".js-rv-media-filter-current").html("(" + a.html() + ")"), n.a.storeConfig(), h.refreshFilter(), n.a.resetPagination(), e.MediaService.getMedia(!0), r.find("> li").removeClass("active"), a.closest("li").addClass("active")
                    }
                })
            }
        }, {
            key: "search", value: function () {
                var e = this;
                $('.input-search-wrapper input[type="text"]').val(n.a.getRequestParams().search || ""), e.$body.on("submit", ".input-search-wrapper", function (t) {
                    t.preventDefault(), i.a.request_params.search = $(this).find('input[type="text"]').val(), n.a.storeConfig(), n.a.resetPagination(), e.MediaService.getMedia(!0)
                })
            }
        }, {
            key: "handleActions", value: function () {
                var e = this;
                e.$body.on("click", '.rv-media-actions .js-change-action[data-type="refresh"]', function (t) {
                    t.preventDefault(), n.a.resetPagination();
                    var a = void 0 !== window.rvMedia.$el ? window.rvMedia.$el.data("rv-media") : void 0;
                    void 0 !== a && a.length > 0 && void 0 !== a[0].selected_file_id ? e.MediaService.getMedia(!0, !0) : e.MediaService.getMedia(!0, !1)
                }).on("click", ".rv-media-items li.no-items", function (e) {
                    e.preventDefault(), $(".rv-media-header .rv-media-top-header .rv-media-actions .js-dropzone-upload").trigger("click")
                }).on("submit", ".form-add-folder", function (t) {
                    t.preventDefault();
                    var a = $(this).find("input[type=text]"), i = a.val();
                    e.FolderService.create(i), a.val("")
                }).on("click", ".js-change-folder", function (t) {
                    t.preventDefault();
                    var a = $(this).data("folder");
                    n.a.resetPagination(), e.FolderService.changeFolder(a)
                }).on("click", ".js-files-action", function (t) {
                    t.preventDefault(), l.handleGlobalAction($(this).data("action"), function (t) {
                        n.a.resetPagination(), e.MediaService.getMedia(!0)
                    })
                })
            }
        }, {
            key: "handleModals", value: function () {
                var e = this;
                e.$body.on("show.bs.modal", "#modal_rename_items", function (e) {
                    l.renderRenameItems()
                }), e.$body.on("submit", "#modal_rename_items .form-rename", function (t) {
                    t.preventDefault();
                    var a = [], i = $(this);
                    $("#modal_rename_items .form-control").each(function () {
                        var e = $(this), t = e.closest(".form-group").data();
                        t.name = e.val(), a.push(t)
                    }), l.processAction({action: i.data("action"), selected: a}, function (t) {
                        t.error ? $("#modal_rename_items .form-group").each(function () {
                            var e = $(this);
                            _.includes(t.data, e.data("id")) ? e.addClass("has-error") : e.removeClass("has-error")
                        }) : (i.closest(".modal").modal("hide"), e.MediaService.getMedia(!0))
                    })
                }), e.$body.on("submit", ".form-delete-items", function (t) {
                    t.preventDefault();
                    var a = [], i = $(this);
                    _.each(n.a.getSelectedItems(), function (e) {
                        a.push({id: e.id, is_folder: e.is_folder})
                    }), l.processAction({action: i.data("action"), selected: a}, function (t) {
                        i.closest(".modal").modal("hide"), t.error || e.MediaService.getMedia(!0)
                    })
                }), e.$body.on("submit", "#modal_empty_trash .rv-form", function (t) {
                    t.preventDefault();
                    var a = $(this);
                    l.processAction({action: a.data("action")}, function (t) {
                        a.closest(".modal").modal("hide"), e.MediaService.getMedia(!0)
                    })
                }), "trash" === i.a.request_params.view_in ? $(document).find(".js-insert-to-editor").prop("disabled", !0) : $(document).find(".js-insert-to-editor").prop("disabled", !1), this.bindIntegrateModalEvents()
            }
        }, {
            key: "checkFileTypeSelect", value: function (e) {
                if (void 0 !== window.rvMedia.$el) {
                    var t = _.first(e), a = window.rvMedia.$el.data("rv-media");
                    if (void 0 !== a && void 0 !== a[0] && void 0 !== a[0].file_type && "undefined" !== t && "undefined" !== t.type) {
                        if (!a[0].file_type.match(t.type)) return !1;
                        if (void 0 !== a[0].ext_allowed && $.isArray(a[0].ext_allowed) && -1 == $.inArray(t.mime_type, a[0].ext_allowed)) return !1
                    }
                }
                return !0
            }
        }, {
            key: "bindIntegrateModalEvents", value: function () {
                var e = $("#rv_media_modal"), t = this;
                e.off("click", ".js-insert-to-editor").on("click", ".js-insert-to-editor", function (a) {
                    a.preventDefault();
                    var i = n.a.getSelectedFiles();
                    _.size(i) > 0 && (window.rvMedia.options.onSelectFiles(i, window.rvMedia.$el), t.checkFileTypeSelect(i) && e.find(".close").trigger("click"))
                }), e.off("dblclick", ".js-media-list-title").on("dblclick", ".js-media-list-title", function (a) {
                    if (a.preventDefault(), "trash" !== n.a.getConfigs().request_params.view_in) {
                        var i = n.a.getSelectedFiles();
                        _.size(i) > 0 && (window.rvMedia.options.onSelectFiles(i, window.rvMedia.$el), t.checkFileTypeSelect(i) && e.find(".close").trigger("click"))
                    } else l.handlePreview()
                })
            }
        }, {
            key: "scrollGetMore", value: function () {
                var e = this;
                $(".rv-media-main .rv-media-items").bind("DOMMouseScroll mousewheel", function (t) {
                    if (t.originalEvent.detail > 0 || t.originalEvent.wheelDelta < 0) {
                        if ($(this).closest(".media-modal").length > 0 ? $(this).scrollTop() + $(this).innerHeight() / 2 >= $(this)[0].scrollHeight - 450 : $(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight - 150) return void 0 !== RV_MEDIA_CONFIG.pagination && RV_MEDIA_CONFIG.pagination.has_more && e.MediaService.getMedia(!1, !1, !0), !1
                    }
                })
            }
        }], [{
            key: "setupSecurity", value: function () {
                $.ajaxSetup({headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")}})
            }
        }]), e
    }();
    $(document).ready(function () {
        window.rvMedia = window.rvMedia || {}, D.setupSecurity(), (new D).init()
    })
}, function (e, t) {
}]);
//# sourceMappingURL=media.js.map
