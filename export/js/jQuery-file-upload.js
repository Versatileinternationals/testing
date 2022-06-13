// This managed file uploads in the client management page

$(function () {
    $("#edit-product-images").fileinput({
        theme: "fas",
        uploadUrl: BASE_URL+"index.php/",
        uploadExtraData: getUploadExtraData(),
        uploadAsync: false,
        initialPreviewAsData: true, // identify if you are sending preview data only and not the raw markup
        initialPreviewFileType: 'image', // image is the default and can be overridden in config below
        minFileCount: 1,
        maxFileCount: 5,
        //maxTotalFileCount: 5,
	validateInitialCount: true,
        overwriteInitial: false,
        allowedFileExtensions: ["jpg", "jpeg", "png"],
	minImageWidth: 800,
	minImageHeight: 500,
	maxImageHeight: 900,
	maxImageWidth: 1080,
        maxFileSize: 2000,
        initialCaption: "Allowed images are, \"jpg\", \".jpeg\" and \".png\"",//,
        initialPreview: getInitialPreview(), //existingDocs.initialPreview,
        initialPreviewConfig: getInitialPreviewConfig(),//existingDocs.initialPreviewConfig       
        showUpload: false
    });
    
    // Confirmation prompt for removing an uploaded file
    $("#edit-product-images").on("filepredelete", function(jqXHR) {
        var abort = true;
        if (confirm("Are you sure you want to delete this image?")) {
            abort = false;
        }
        return abort; // you can also send any data/object that you can receive on `filecustomerror` event
    });

    /*$("#add-product-images").fileinput({
        theme: "fas",
        showUpload: false,
        fileActionSettings: { showZoom: false},
        indicatorNewTitle: 'Not uploaded yet',

        // uploadUrl: BASE_URL+"upload-file/",
        // uploadAsync: false,
        // initialPreviewAsData: true, // identify if you are sending preview data only and not the raw markup
        // initialPreviewFileType: 'image', // image is the default and can be overridden in config below
        maxFileCount: 5,
        maxTotalFileCount: 5,
        overwriteInitial: false,
        allowedFileExtensions: ["jpg", "jpeg", "png"],
	minImageWidth: 800,
	minImageHeight: 500,
	maxImageHeight: 900,
	maxImageWidth: 1080,
        maxFileSize: 2000,
        initialCaption: "Acceptable files are, \"jpg\", \".jpeg\" and \".png\""//,
        // initialPreview: , //existingDocs.initialPreview,
        // initialPreviewConfig: //existingDocs.initialPreviewConfig       
    });*/

    $("#add-product-images").fileinput({
        theme: "fas",
        showUpload: false,
        fileActionSettings: { showZoom: false},
        indicatorNewTitle: 'Not uploaded yet',
        maxFileCount: 5,
        maxTotalFileCount: 5,
        overwriteInitial: false,
        allowedFileExtensions: ["jpg", "jpeg", "png"],
	minImageWidth: 800,
	minImageHeight: 500,
	maxImageHeight: 900,
	maxImageWidth: 1080,
        maxFileSize: 2000,
        initialCaption: "Allowed images are, \".jpg\", \".jpeg\" and \".png\""
    });
	

    $("#add-sector-image").fileinput({
        theme: "fas",
        showUpload: false,
        fileActionSettings: { showZoom: false},
        indicatorNewTitle: 'Not uploaded yet',

        // uploadUrl: BASE_URL+"upload-file/",
        // uploadAsync: false,
        // initialPreviewAsData: true, // identify if you are sending preview data only and not the raw markup
        // initialPreviewFileType: 'image', // image is the default and can be overridden in config below
        maxFileCount: 1,
        maxTotalFileCount: 1,
        overwriteInitial: false,
        allowedFileExtensions: ["jpg", "jpeg", "png"],
	minImageWidth: 800,
	maxImageWidth: 1080,
	minImageHeight: 400,
	maxImageWidth: 900,
        maxFileSize: 2000,
        initialCaption: "Acceptable files are, \"jpg\", \".jpeg\" and \".png\""//,
        // initialPreview: , //existingDocs.initialPreview,
        // initialPreviewConfig: //existingDocs.initialPreviewConfig       
    });

});
