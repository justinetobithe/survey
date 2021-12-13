<!DOCTYPE html>
<html lang="en">

<head>
    <title>Prototype Survey PVS</title>
    <link rel="stylesheet" href="assets/css/custom.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <?php require 'components/links.php' ?>
</head>

<body>
    <div class="root p-0 vh-100 bg-white">
        <?php require 'components/sidenav.php' ?>
        <nav class="navbar main-navigation-bar in-my-surveys">
            <ul class="navbar-nav main-nav-btn is-normal-btn has-icon-only" id="side-nav-collapse">
                <li class="nav-item" id="side-nav-collapse">
                    <i class="fa fa-bars icon text-light mx-3" id="icon-nav-toggle"></i>
                </li>
            </ul>
            <div class="sidebar-header-title">My Surveys</div>
        </nav>

        <div class="container">
            <div class="list-of-surveys-area" id="list-of-surveys-area">
                <div class="list-of-surveys" id="list-of-surveys"> 
                    <div class="survey-thumbnail new-from-scratch ng-scope" id="create-survey">
                        <div class="survey-title">Create new</div>
                        <div class="survey-title create-what-more">survey, form or poll</div>
                    </div>

                </div>

                <div id="survey-side-panel" class="survey-panel-nav">
                    <div class="container px-2 d-flex flex-column">
                        <div class="d-flex justify-content-start">
                            <label class="mx-1"><b>Date Created :</b></label>
                            <label class="mx-1" id="lbl-created-at">-</label>
                        </div>
                        <div class="d-flex justify-content-start">
                            <label class="mx-1"><b>Date Update :</b></label>
                            <label class="mx-1" id="lbl-update-at">-</label>
                        </div>
                        <div class="d-flex justify-content-around my-2">
                            <a href="#" class="btn bg-white d-flex align-items-center justify-content-center" id="btn-survey-edit"><i class="nav-bar-edit-icon"></i> Edit</a>
                            <a href="#" class="btn bg-white d-flex align-items-center justify-content-center" id="btn-survey-view"><i class="nav-bar-preview-icon"></i>Preview</a>
                            <a href="#" class="btn btn-white d-flex align-items-center justify-content-center" id="btn-survey-delete"><i class="nav-bar-delete-icon"></i>Delete</a>
                        </div>
                        <div class="my-2">
                            <input type="text" class="form-control shadow-none" readonly="readonly" id="tb-link-generate">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header no-padding">
                    <div class="table-header">
                       Create new survey
                        
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container col-12">
                        <form class="my-2" method="post" action="" id="form-modal">
                            <div class="form-group my-3">
                                <label for="formGroupExampleInput">Title :</label>
                                <input type="text" class="form-control shadow-none" id="tb-title" placeholder="Enter Title">
                            </div>
                            <div class="form-group my-3">
                                <label for="formGroupExampleInput2">Description :</label>
                                <input type="text" class="form-control shadow-none" id="tb-description" placeholder="Enter Description">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" id="btn-create" class="btn btn-primary text-white">Create</button>
                </div>
            </div>
        </div>
    </div>


    <?php require 'components/scripts.php' ?>
    <script>
        $(document).ready(function() {

            //global variables
            var isCollapse = false;
            var isCollapseSurveyPanel = false;
            //end
            //if component mount
            getSurvey();
            //end
            //functions
            function resetFormModal() {
                $('#form-modal').trigger('reset');
                $('#myModal').modal('hide');
            };

            function createNewSurvey(data) {
                $.ajax({
                    url: 'backend/createSurvey.php',
                    type: 'POST',
                    data: data,
                    success: response => {
                        if (response === 0) {
                            console.log('All fields must be required!');
                        } else if (response === 1) {
                            console.log('Something went wrong!');
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Your survey has been saved',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                resetFormModal();
                                getSurvey();
                            });
                        }
                    }
                });
            }

            function getSurvey() {
                $.ajax({
                    url: 'backend/getSurvey.php',
                    data: {
                        type: 'all'
                    },
                    type: 'POST',
                    success: response => {
                        const parsedResponse = JSON.parse(response);
                        var survey_data = "";
                        $.each(parsedResponse, function(key, {
                            survey_id,
                            survey_title,
                            survey_description
                        }) {

                            survey_data += "<div class='survey-thumbnail ng-scope dynamic-row' id=" + survey_id + ">";
                            survey_data += "    <div class='theme-properties theme-classic'>";
                            survey_data += "        <div class='survey-title ng-binding'>" + survey_title + "</div>";
                            survey_data += "        <div class='preview-tooltips' id='preview-tooltips'>Quick preview</div>";
                            survey_data += "        <div class='survey-background'></div>";
                            survey_data += "    </div>";
                            survey_data += "</div>";
                        });
                        $('.dynamic-row').remove();
                        $('#list-of-surveys').append(survey_data);

                        $('.dynamic-row').click(function(event) {
                            event.stopPropagation();
                            // $('#list-of-surveys-area').css("margin-right", "350px");
                            $('.container').css("margin", "0px 0px 350px 0px");
                            $('#survey-side-panel').css("width", "350px");
                            getSurveyDetailsByID(this.id);
                            isCollapseSurveyPanel = true;
                        });
                    }
                })
            }

            function deleteSurveyByID(id) {
                $.ajax({
                    url: 'backend/deleteSurvey.php',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: response => {
                        if (response) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Your survey has been deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => getSurvey());
                        }
                    }
                })
            }

            function getSurveyDetailsByID(id) {
                if (id.length !== 0) {
                    $.ajax({
                        url: 'backend/getSurvey.php',
                        type: 'POST',
                        data: {
                            type: 'getByID',
                            id: id
                        },
                        success: response => {

                            const {
                                survey_id,
                                url_key,
                                survey_title,
                                survey_description,
                                created_at,
                                updated_at
                            } = JSON.parse(response);
                            $('#lbl-created-at').text(created_at);
                            $('#lbl-update-at').text(updated_at);
                            $('#tb-link-generate').val('http://localhost/survey/app/r/?' + url_key);
                            $('#btn-survey-view').attr("href", "http://localhost/survey/app/r/?" + url_key);
                            $('#btn-survey-view').attr("target", "_blank");
                            $('#btn-survey-edit').attr("href", "http://localhost/survey/app/?" + url_key);
                            $('#btn-survey-delete').val(survey_id);
                        }
                    });
                }
            }
            //end
            //events

            //script for survey-panel
            $(window).click(function(event) {
                event.stopPropagation();
                if (isCollapseSurveyPanel) {
                    // $('#list-of-surveys-area').css("margin-right", "0px");
                    $('.container').css("margin", "0 auto");
                    $('.container').css("-webkit-transition", "width 1s ease-in-out");
                    $('.container').css("-moz-transition", "width 1s ease-in-out");
                    $('.container').css("-o-transition", "width 1s ease-in-out");
                    $('.container').css("transition", "width 1s ease-in-out");
                    $('#survey-side-panel').css("width", "0px");

                    isCollapseSurveyPanel = false;
                }
                if (isCollapse) {
                    $('#mySidenav').css('width', '0px');
                    $('.root').css('margin-left', '0px');
                    $('#icon-nav-toggle').removeClass('fas fa-times text-danger').addClass('fa fa-bars text-light');
                    isCollapse = false;
                }
            });

            //script for side nav
            $('#side-nav-collapse').click(function(event) {
                event.stopPropagation();
                isCollapse = !isCollapse;
                //side nav is shown
                if (isCollapse) {
                    $('#mySidenav').css('width', '300px');
                    $('.root').css('margin-left', '300px');
                    $('#icon-nav-toggle').removeClass('fa fa-bars text-light').addClass('fas fa-times text-danger');
                    isCollapse = true;
                }
                //side nav is hidden
                else if (!isCollapse) {
                    $('#mySidenav').css('width', '0px');
                    $('.root').css('margin-left', '0px');
                    $('#icon-nav-toggle').removeClass('fas fa-times text-danger').addClass('fa fa-bars text-light');
                    isCollapse = false;
                }
                console.log(isCollapse);
            });
            //end
            //script for modal
            $('#create-survey').click(function() {
                $('#myModal').modal('show');
                resetFormModal();
            });
            $('#btn-cancel').click(function() {
                $('#myModal').modal('hide')
            });

            $('#tb-title').change(function() {
                if ($('#tb-title').val().length > 0) {
                    $('#err-title').remove();
                }
            });

            $('#tb-description').change(function() {
                if ($('#tb-description').val() > 0) {
                    $('#err-desc').remove();
                }
            });

            $('#btn-create').click(function() {
                var errCounter = 0;

                if ($('#tb-title').val().length === 0) {
                    $('#err-title').remove();
                    $('#tb-title').after("<p class='text-danger my-2 p-1' id='err-title'>Title is required!</p>");
                    errCounter++;
                }

                if ($('#tb-description').val().length === 0) {
                    $('#err-desc').remove();
                    $('#tb-description').after("<p class='text-danger my-2 p-1' id='err-desc'>Description is required!</p>");
                    errCounter++;
                }

                if (errCounter === 0) {
                    const data = {
                        title: $('#tb-title').val(),
                        description: $('#tb-description').val()
                    };
                    createNewSurvey(data);
                }
            });

            $('#btn-survey-delete').click(function() {
                if ($(this).val().length > 0) {
                    Swal.fire({
                        title: 'Are you sure you want to delete this survey?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#0dcaf0',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            deleteSurveyByID($(this).val());
                        }
                    });
                }
            });

            $('#survey-side-panel').click(function(event) {
                event.stopPropagation();
            });
            //end
        });
    </script>
</body>

</html>