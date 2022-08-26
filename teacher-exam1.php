<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Forms</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="vendor/animate/animate.css">

		<link rel="stylesheet" href="vendor/font-awesome/css/all.min.css" />
		<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="css/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="css/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="css/custom.css">

		<!-- Head Libs -->
		<script src="vendor/modernizr/modernizr.js"></script>
        <style>
            #signal0 {
				display : none;
			}
            #signal1 {
				display : none;
			}
        </style>

	</head>
<body>
                                <section class="card">

                                    <div class="card-body">
                                    <div class="row">
                                    <div class="col-lg-4">
                                    </div>
                                    <div class="col-lg-6">
                                    </div>
                                    <div class="col-lg-2">
                                    <div class="card-body" id="signal0">
                                    <button type="button" class="btn btn-sm btn-default" style="color: red;"><i class="fa fa-signal" aria-hidden="true"></i>&nbsp&nbspNot Connected</button>
                                    </div>
                                    <div class="card-body" id="signal1">
                                    <button type="button" class="btn btn-sm btn-default" style="color: green;"><i class="fa fa-signal" aria-hidden="true"></i>&nbsp&nbspConnected</button>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="alert" id="alert" style="font-size: 38px; color: blue"></div>
										<form class="form-horizontal form-bordered" id="save-later-form" method="get">
                                            
                                            <div class="form-group row">
												<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault"></label>
												<div class="col-lg-6">
                                                <h2>Your Test</h2>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">2 +13 =</label>
												<div class="col-lg-6">
													<input type="text" class="form-control" name="ans1" id="ans1" placeholder="Answer 1">
												</div>
											</div>
						
											<div class="form-group row">
												<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">11 IS GREATER THAN 12</label>
												<div class="col-lg-6">
													<input type="text" class="form-control" name="ans2" id="ans2" placeholder="Answer 1">
												</div>
											</div>

                                            <div class="form-group row">
												<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">5 x 6 = </label>
												<div class="col-lg-6">
													<input type="text" class="form-control" name="ans3" id="ans3" placeholder="Answer 1">
												</div>
											</div>

                                            <div class="form-group row">
												<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">write SEVENTEEN as number</label>
												<div class="col-lg-6">
													<input type="text" class="form-control" name="ans4" id="ans4" placeholder="Answer 4">
												</div>
											</div>

                                            <div class="form-group row">
												<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">5 is LESS THAN 7</label>
												<div class="col-lg-6">
													<input type="text" class="form-control" name="ans5" id="ans5" placeholder="Answer 5">
												</div>
											</div>

                                            <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault"></label>
												<div class="col-lg-6">
                                                        <!-- <button class="btn btn-success btn-lg" id="save">Save as Draft</button> -->
                                                        <!-- &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp -->
                                                        <button class="btn btn-info btn-lg" id="submit">Submit</button>
												</div>
                                            </div>
						
											
										</form>
									</div>
                                </section>

</body>
<script>
    const formId = "save-later-form"; // ID of the form
    const url = location.href; //  href for the page
    const formIdentifier = `${url} ${formId}`; // Identifier used to identify the form
    // const saveButton = document.querySelector("#save"); // select save button
    const submitButton = document.querySelector("#submit"); // select save button
    const alertBox = document.querySelector(".alert"); // select alert display div
    const signal = document.querySelector(".signal");
    let form = document.querySelector(`#${formId}`); // select form
    let formElements = form.elements; // get the elements in the form
    const getFormData = () => {
  let data = { [formIdentifier]: {} };
  for (const element of formElements) {
    if (element.name.length > 0) {
      data[formIdentifier][element.name] = element.value;
    }
  }
  return data;
};

submitButton.onclick = event => {
        if (navigator.onLine) {
            alert("Test submitted successfully!!");
            localStorage.clear()
        }
        else{
            event.preventDefault();
            data = getFormData();
            localStorage.setItem(formIdentifier, JSON.stringify(data[formIdentifier]));
            const message = "Form draft has been saved!";
            displayAlert(message);

        }
};

/**
 * This function displays a message
 * on the page for 1 second
 *
 * @param {String} message
 */
const displayAlert = message => {
  alertBox.innerText = message;
  alertBox.style.display = "block";
  setTimeout(function() {
    alertBox.style.display = "none";
  }, 10000);
};

/**
 * This function populates the form
 * with data from localStorage
 *
 */
// submitButton.onclick = event => {
//     const answers = []
//     if (localStorage.key(formIdentifier)) {
//     const savedData = JSON.parse(localStorage.getItem(formIdentifier)); // get and parse the saved data from localStorage
//     for (const element of formElements) {
//       if (element.name in savedData) {
//         answers.push(savedData[element.name]);
//       }
//     }
//     if (navigator.onLine) {
//         alert("Test submitted successfully");
//         window.localStorage.clear();
//     }
//     else {
//         alert("Check your network connection");
//         document.reload()
//     }
//   }
// };
const populateForm = () => {
  if (localStorage.key(formIdentifier)) {
    const savedData = JSON.parse(localStorage.getItem(formIdentifier)); // get and parse the saved data from localStorage
    for (const element of formElements) {
      if (element.name in savedData) {
        element.value = savedData[element.name];
      }
    }
  }
};

document.onload = populateForm();

// setInterval(function() {
//     if (navigator.onLine){
//     document.getElementById('signal0').style.display = "none";
//     document.getElementById('signal1').style.display = "block";
//   }
//   else{
//     document.getElementById('signal0').style.display = "block";
//     document.getElementById('signal1').style.display = "none";
//   }

// },1000);
function updateConnectionStatus() {  
    if(navigator.onLine) {
        document.getElementById('signal0').style.display = "none";
        document.getElementById('signal1').style.display = "block";
    }
    else{
        document.getElementById('signal0').style.display = "block";
        document.getElementById('signal1').style.display = "none";
    }
}
window.addEventListener("load", updateConnectionStatus);
    
// Attaching event handler for the online event
window.addEventListener("online", function(e) {
    updateConnectionStatus();
    hint.innerHTML = "And we're back!";
});

// Attaching event handler for the offline event
window.addEventListener("offline", function(e) {        
    updateConnectionStatus();
    hint.innerHTML = "Hey, it looks like you're offline.";
});

</script>
</html>


