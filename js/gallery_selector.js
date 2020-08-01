let gallery = document.querySelectorAll(".js-gallery");
		gallery.forEach(element => {
			// console.log(element);
		});

		// reduce check to 5
		let checks = document.querySelectorAll(".check");
		var max = 5;
		for (var i = 0; i < checks.length; i++) {
			checks[i].onclick = selectiveCheck;

			function selectiveCheck(event) {
				var checkedChecks = document.querySelectorAll(".check:checked");
                var totalChecked = checkedChecks.length;
                if(totalChecked > 5 ){
                    $("#gallery_selected_message").html(`Maximum is 5 Selected`);
                }else {
                    $("#gallery_selected_message").html(`You Selected ${totalChecked} Gallery`)
                }
				if (totalChecked >= max + 1)
					return false;
			}
		}