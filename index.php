<?php
/**
 * A small project using Clever
 *
 */

require_once("clever-php-master/lib/Clever.php");
Clever::setToken("DEMO_TOKEN");

?>

<!DOCTYPE html>
<html>
<head>
	<title>A Clever Project</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <!-- bootstrap -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet">

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="css/compiled/layout.css">
    <link rel="stylesheet" type="text/css" href="css/compiled/elements.css">
    <link rel="stylesheet" type="text/css" href="css/compiled/icons.css">

    <!-- libraries -->
    <link href="css/lib/uniform.default.css" type="text/css" rel="stylesheet">
    <link href="css/lib/select2.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/lib/font-awesome.css">
    
    <!-- this page specific styles -->
    <link rel="stylesheet" href="css/compiled/form-wizard.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/compiled/personal-info.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/compiled/form-showcase.css" type="text/css" media="screen" />
	
    <!-- open sans font -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
		
		
</head>
<body>

    <!-- navbar -->
    <header class="navbar navbar-inverse" role="banner">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html"><img src="img/logo.png"></a>
        </div>
        <nav class="collapse navbar-collapse" role="navigation">
            <ul class="nav navbar-nav" style="float: right;">
				<li style="margin-top:10px;">
                    <select style="width:250px;" class="select2">
						
						
						<?php
						$teachers = CleverTeacher::all();
			
			
			
						foreach ($teachers as $teacher) {
							$teacher_json = json_decode($teacher,true);
							$teacher_id = $teacher_json['id'];
							$teacher_first = $teacher_json['name']['first'];
							$teacher_last = $teacher_json['name']['last'];
							
							echo "<option value=\"$teacher_id\">$teacher_first $teacher_last</option>";
						}
	
						?> <!-- TODO: Change the displayed teacher when this is changed -->
						
                    </select>
				</li>
                <li class="visible-lg">
                    <input class="search" type="text" style="margin-left:30px;" value="Nope, this doesn't do anything"/>
                </li>
            </ul>
        </nav>        
    </header>
    <!-- end navbar -->

	<!-- main container .wide-content is used for this layout without sidebar :)  -->
    <div class="content wide-content">
        <div class="settings-wrapper" id="pad-wrapper">
            <div class="row">
				
                <!-- avatar column -->
                <div class="col-md-2 col-md-offset-1 avatar-box">
                    <div class="personal-image">
						
						<?php
						
							$selected_teacher = Cleverteacher::retrieve("509fbd7ec474fab64a8e9d53");
							$selected_json = json_decode($selected_teacher,true);
						
							$district_id = $selected_json['district'];
							$district = Cleverdistrict::retrieve($district_id);
							$district_json = json_decode($district,true);
						
							$teacher_district = $district_json['name'];
							$teacher_first = $selected_json['name']['first'];
							$teacher_last = $selected_json['name']['last'];
							$teacher_email = $selected_json['email'];
							$teacher_title = $selected_json['title'];						
						
						?>
						
                        <img src="img/personal-info.png" class="avatar img-circle">
                        <p style="font-weight:bold;"><?php echo $teacher_first; ?> <?php echo $teacher_last; ?></p> <!-- TODO: GET THIS FROM API -->
						<p style="font-weight:normal;"><?php echo $teacher_title; ?></p> <!-- TODO: GET THIS FROM API -->
						<p style="font-weight:normal;"><?php echo $teacher_email; ?></p> <!-- TODO: GET THIS FROM API -->
						<p style="font-weight:normal;"><?php echo $teacher_district; ?></p> <!-- TODO: GET THIS FROM API -->
                    </div>
                </div>

                <!-- edit form column -->
                <div class="col-md-9 col-xs-9">
				
	                <div id="fuelux-wizard" class="wizard row">
	                    <ul class="wizard-steps">
							
	                        <li data-target="#step1" class="active">
	                            <span class="step">1</span>
	                            <span class="title">Select <br> Template</span>
	                        </li>
	                        <li data-target="#step2">
	                            <span class="step">2</span>
	                            <span class="title">Select <br> Student</span>
	                        </li>
	                    </ul>                            
	                </div>
					
					<form id="account-form" method="POST" action="file.php">
						
					<input type="hidden" value="<?php echo $teacher_first; ?> <?php echo $teacher_last; ?>" name="teacher" />
						
                    <div class="step-content">
                        <div class="step-pane active" id="step1">
                            <div class="row form-wrapper">
                                <div class="col-md-8">									
										<center><table class="inline">
											<tbody>
												
												<tr>
													<td><img src="my_images/temp1.png" width="150px" /></td>
													<td><img src="my_images/temp2.png" width="150px" /></td>
												</tr>
												<tr>
													<td style="padding-left:40px;"><label for="diploma"><input type="radio" id="diploma" name="template" value="temp1"  class="required" style="display:none;" checked><span class="btn2 G">Select</span></label></td>
													<td style="padding-left:40px;"><label for="soty"><input type="radio" id="soty" name="template" value="temp2"  class="required" style="display:none;"><span class="btn2 G">Select</span></label></td>
												</tr>
											</tbody>
										</table></center>
                                </div>
                            </div>
                        </div>
                        <div class="step-pane" id="step2">
                            <div class="row form-wrapper">
                                <div class="col-md-8">
                                    <div class="field-box">
										
										<label>Select your class:</label>
					                    <select class="select" name="section" id="section">
						
											<?php
											
											$sections = $selected_teacher -> sections();
											$sections_array = array();		
																																												
											foreach ($sections as $section) {
												$section_json = json_decode($section,true);
												$section_name = $section_json['course_name'];
												$section_id = $section_json['id'];

												$sections_array[] = $section_id;
												
							
												echo "<option value=\"$section_id\">$section_name</option>";
											}
	
											?> 
						
					                    </select>
										

                                    </div>
									<div id="error"></div>
                                    <div id="result" class="field-box">
										
										<label>Select your student:</label>
					                    <select class="select" name="student" id="list">
												
											<?php
											
											$section_id = reset($sections_array);
																						
											$selected_section = CleverSection::retrieve($section_id);
											$students = $selected_section -> students();
											
											foreach ($students as $student) {
												$student_json = json_decode($student,true);
												$student_id = $student_json['student_number'];
												$student_first = $student_json['name']['first'];
												$student_last = $student_json['name']['last'];
																								
												echo "<option value=\"$student_first $student_last\">$student_first $student_last</option>";
											}											
	
											?> 
						
					                    </select>
									</div>
                                </div>
                            </div>
                        </div>
						
	                    <div class="wizard-actions">
	                        <button type="button" disabled class="btn-glow primary btn-prev"> 
	                            <i class="icon-chevron-left"></i> Prev
	                        </button>
	                        <button type="button" class="btn-glow primary btn-next" data-last="Finish">
	                            Next <i class="icon-chevron-right"></i>
	                        </button>
							<input type="submit" name="SignUp" class="btn-glow success btn-finish" value="Create the file"></input>							
	                    </div>
					</form>
						
				</div>
                
            </div>            
        </div>
    </div>
    <!-- end main container -->

	<!-- scripts for this page -->
    <script src="http://code.jquery.com/jquery-latest.js"></script> <!-- Old -->
    <script src="js/bootstrap.min.js"></script> <!-- Old -->
    <script src="js/select2.min.js"></script>
    <script src="js/theme.js"></script> <!-- Old -->
    <script src="js/fuelux.wizard.js"></script> <!-- Old -->
	
    <script type="text/javascript">

        $(document).ready(function () {
					
            // if user chooses an option from the select box...
            $("#section").change(function () {
                // get selected value from selectbox with id #section
                var selected_section = $(this).val();
                $.ajax({

                    url: "getStudents.php",
                    data: "q=" + selected_section,
                    dataType: "json",
										

                    // if successful
                    success: function (response, textStatus, jqXHR) {

                        // no teachers found -> an empty array was returned from the backend
                        if (response.student_names.length == 0) {
                            $('#result').html("nothing found");
                        }
                        else {
                            // backend returned an array of names
                            var list = $("#list");

                            // remove items from previous searches from the result list
                            $('#list').empty();

                            // append each teachername to the drop down and wrap in <li>
                            $.each(response.student_names, function (i, val) {
                                list.append($("<option value='" + val + "'>" + val + "</option>"));
                            });
                        }
                    }});
            });


            // if anywhere in our application happens an ajax error,this function will catch it
            // and show an error message to the user
            $(document).ajaxError(function (e, xhr, settings, exception) {
                $("#error").html("<div class='alert alert-warning'> Ooops! An error occurred.</div>");
            });

        });

    </script>
	
	
	
	
    <script type="text/javascript">
        $(function () {
            var $wizard = $('#fuelux-wizard'),
                $btnPrev = $('.wizard-actions .btn-prev'),
                $btnNext = $('.wizard-actions .btn-next'),
                $btnFinish = $(".wizard-actions .btn-finish");

            $wizard.wizard().on('finished', function(e) {
                // wizard complete code
            }).on("changed", function(e) {
                var step = $wizard.wizard("selectedItem");
                // reset states
                $btnNext.removeAttr("disabled");
                $btnPrev.removeAttr("disabled");
                $btnNext.show();
                $btnFinish.hide();

                if (step.step === 1) {
                    $btnPrev.attr("disabled", "disabled");
                } else if (step.step === 2) {
                    $btnNext.hide();
                    $btnFinish.show();
                }
            });

            $btnPrev.on('click', function() {
                $wizard.wizard('previous');
            });
            $btnNext.on('click', function() {
                $wizard.wizard('next');
            });
			
            // select2 plugin for select elements
            $(".select2").select2({
                placeholder: "Select a Teacher"
            });
			
        });
    </script>
</body>
</html>