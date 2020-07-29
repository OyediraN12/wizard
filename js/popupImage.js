function def(imageId){
    // Get the modal
    var modal = document.getElementById("myModal");
    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = imageId.id;
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    // modal actions
    modal.style.display = "block";
    modalImg.src = imageId.dataset.new;
    captionText.innerHTML = imageId.alt;

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    modal.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() { 
      modal.style.display = "none";
    }

  }