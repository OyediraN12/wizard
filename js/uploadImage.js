window.onload = function () {
    var fileUpload = document.getElementById("fileupload");
    fileUpload.onchange = function () {
        if (typeof (FileReader) != "undefined") {
            var dvPreview = document.getElementById("dvPreview");
            dvPreview.innerHTML = "";
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            for (var i = 0; i < fileUpload.files.length; i++) {
                var file = fileUpload.files[i];
                if (regex.test(file.name.toLowerCase())) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = document.createElement("IMG");
                        img.height = "100";
                        img.width = "100";
                        img.src = e.target.result;
                        img.id = "bob"
                        img.style = "padding-right:30px"
                        dvPreview.appendChild(img);
                    }
                    reader.readAsDataURL(file);
            } else {
                    console.log(file.name + " is not a valid image file.");
                    dvPreview.innerHTML = "";
                    return false;
                }
                // dvPreview.appendChild("<br />");
            }
        } else {
            console.log("This browser does not support HTML5 FileReader.");
        }
    }
};