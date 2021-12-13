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
            url: '../../../backend/createSurvey.php',
            type: 'POST',
            data: data,
            success: response => {
                if (response === 0) {
                    console.log('all fields required!');
                } else if (response === 1) {
                    console.log('something went wrong!');
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Your work has been saved',
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
                    title,
                    description
                }) {
                    survey_data += "<div class='dynamic-row col-lg-4 p-2' id=" + survey_id + ">";
                    survey_data += "<div class='survey-card rounded shadow bg-white mx-auto'>";
                    survey_data += "<div class='card-title'>" + title + "</div>";
                    survey_data += "<p class='card-text'>" + description + "</div>";
                    survey_data += "</div>";
                    survey_data += "</div>";
                });
                $('.dynamic-row').remove();
                $('#surveys-row').append(survey_data);

                $('.dynamic-row').click(function(event) {
                    event.stopPropagation();
                    $('#surveys-row').css("margin-right", "350px");
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
                survey_id: id
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
                    survey_id: id
                },
                success: response => {

                    const {
                        survey_id,
                        title,
                        description,
                        created_at,
                        modified_at
                    } = JSON.parse(response);
                    console.log(created_at);
                    $('#lbl-created-at').text(created_at);
                    $('#lbl-modified-at').text(modified_at);
                    $('#tb-link-generate').val('http://localhost/develop/survey/answer-survey.php?id=' + survey_id);
                    $('#btn-survey-view').attr("href", "http://localhost/develop/survey/answer-survey.php?id=" + survey_id + "");
                    $('#btn-survey-edit').attr("href", "http://localhost/develop/survey/?id=" + survey_id + "");
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
            $('#surveys-row').css("margin-right", "0px");
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