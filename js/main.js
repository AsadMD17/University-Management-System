// _________________________________________________Student-Modal-Script_________________________________________________________//
// new added for view students details
var old_sec = "";
var old_teacher = "";
var del_old_sec = "";
var del_old_teacher = "";
var course_old_id = "";
var btn_count = 1;
varObj = { a: 0 };
varObj2 = { a: 0 };
var att_date ="";
var course_id ="";
var sec = "";
var att_date1 ="";
var course_id1 = "";
var sec1 = "";
        



$(document).ready(function () {

    $(document).on("click", ".student_view_btn", function () {

        var stud_id = $(this).closest('tr').find('.stud_id').text();
        modal_view_students(stud_id);
    });
    //for auto filling in  edit students
    $(document).on("click", ".student_edit_btn", function () {

        var stud_id = $(this).closest('tr').find('.stud_id').text();
        modal_edit_students(stud_id);
    });

    //for delete students
    $(document).on("click", ".student_delete_btn", function () {
        var stud_id = $(this).closest('tr').find('.stud_id').text();
        $('#student_id_del').val(stud_id);
        $('#Student_delete_modal').modal('show');
    });

    //for search students

    $("#search_value_students").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#student_table tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    // _________________________________________________Teacher-Modal-Script_________________________________________________________//

    // new added for view teacher details

    $(document).on("click", ".teacher_view_btn", function () {

        var teacher_id = $(this).closest('tr').find('.teacher_id').text();
        modal_view_teachers(teacher_id);
    });


    //for auto filling in  edit teachers
    $(document).on("click", ".teacher_edit_btn", function () {

        var teacher_id = $(this).closest('tr').find('.teacher_id').text();
        modal_edit_teachers(teacher_id);
    });

    //for delete teachers
    $(document).on("click", ".teacher_delete_btn", function () {

        var teacher_id = $(this).closest('tr').find('.teacher_id').text();
        $('#teacher_id_del').val(teacher_id);
        $('#teacher_delete_modal').modal('show');
    });
    //for search teachers
    $("#search_value_teachers").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#teacher_table tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // _________________________________________________Course-Modal-Script_________________________________________________________//

    $('#add_course').on('click', function (e) {
        e.preventDefault();
         add_courses();
    });



    //for auto filling in  edit courses
    $(document).on("click", ".course_edit_btn", function () {

        var course_id = $(this).closest('tr').find('.course_id').text();
        modal_edit_courses(course_id)

    });
    //for search courses
    $("#search_value_course").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#course_table tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    //for deleting a course

    $(document).on("click", ".course_delete_btn", function () {

        var course_id = $(this).closest('tr').find('.course_id').text();
        $('#course_id_del').val(course_id);
        $('#course_delete_modal').modal('show');
    });

    //_____________________________________________________Assign Teacher modal_________________________________________________________________///

    //Assign teachers to students modal 
    $(document).on("click", ".course_assign_btn", function () {
        $('.assign_course_msg').html("");
        $('#teacher_assign_modal').modal('show');
    });

    $(document).on("click", ".assign_edit_btn", function () {
    //$('.assign_course_msg').html("");
        old_sec = $(this).closest('tr').find('.course_teacher_sec').text();
        old_teacher = $(this).closest('tr').find('.course_teacherid').text();
        var course_edit_id = $(this).closest('tr').find('.course_teacher_id').text();

        $('#teacher_id_assign_edit').val(old_teacher);
        $('#assign_sec_edit').val(old_sec);
        $('#course_id_assign_edit').val(course_edit_id);
        $('#assign_edit_modal').modal('show');
    });
    //for search course-teachers
    $("#search_assigned_course").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#course-teacher-table tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    //for view a course-teacher del modal

    $(document).on("click", ".assign_delete_btn", function () {
        del_old_sec = $(this).closest('tr').find('.course_teacher_sec').text();
        del_old_teacher = $(this).closest('tr').find('.course_teacherid').text();
        course_old_id = $(this).closest('tr').find('.course_teacher_id').text();
        var assign_course_id = $(this).closest('tr').find('.course_teacher_id').text();

        $('#course_teacher_id_del').val(assign_course_id);
        $('#course_teacher_delete_modal').modal('show');
    });

    //for deleting a course-teacher
    $(document).on("click", "#model_del_course_teacher", function (e) {
        e.preventDefault();
        delete_course_teacher();
        $('#course_teacher_delete_modal').modal('hide');
    });

  //----------------------------------------------------------Change Password-----------------------------------
    $(document).on("click", ".pass_change", function() {

        change_password();

    });

    //_____________________________________________________Attendance_________________________________________________________________///

     // view attendance
    $(document).on("click", ".attendance_view_btn", function () {

        var course_id = $(this).closest('tr').find('.course_id').text();
        attendance_view(course_id);
    });

    // show course attendance
    $(document).on("click", "#edit_get_attendance", function (e) {
        e.preventDefault();
        edit_attendance();

    });
   // edit model attendance
   
   $(document).on("click", "#attendance_edit_btn", function () {
     att_date = $(this).closest('tr').find('.att_Date').text();
     course_id = $(this).closest('tr').find('.Course_ID').text();
     sec = $(this).closest('tr').find('.Section').text();
    get_date_attendance(att_date,course_id,sec);
   
    });

    // update attendance
    $(document).on("click", "#udpate_attendance", function () {
        update_attendance(varObj2 , att_date, course_id,sec);    
    });
  
    // delete attendance    

    $(document).on("click", "#model_del_attendance", function (e) {
 
        e.preventDefault();  
        delete_attendance(att_date1,course_id1,sec1 );
        $('#attendance_delete_modal').modal('hide');
    });

   // delete attendance modal    

    $(document).on("click", ".attendance_delete_btn", function () {
        att_date1 = $(this).closest('tr').find('.att_Date').text();
         course_id1 = $(this).closest('tr').find('.Course_ID').text();
         sec1 = $(this).closest('tr').find('.Section').text();

        $('#attendance_delete_modal').modal('show');
          
    });
  

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar, #content').toggleClass('active');
    });


    $('#get-students').on('click', function (e) {
        e.preventDefault();
        var btn_count = 1;
        varObj = { a: 0 }        
        get_students_info(btn_count, varObj);
    });

    $('#assign_teacher').on('click', function (e) {
        e.preventDefault();

        assign_course_teacher();
    });
    $('#assign_teacher_edit').on('click', function (e) {
        e.preventDefault();
        edit_course_teacher();
    });


    $('#add-attendance-search').append(
        "  <input type='submit' id='cancel-attendance' class='btn bg-light ml-3 mb-3'  name='refresh' value='Discard'>"

    );
    $('#save-attendance').append(
        "  <input type='submit' id='save-attendance-btn' class='btn bg-success ml-3 mb-3'  name='save-attendance-btn' value='Save'>"
    );

    $('#save-attendance-btn').on('click', function (e) {
        e.preventDefault();
        save_attendance(varObj);
    });


    document.getElementById('cancel-attendance').style.visibility = 'hidden';
    document.getElementById('save-attendance').style.visibility = 'hidden';

    $('#cancel-attendance').on('click', function (e) {
        e.preventDefault();
        document.getElementById('get-students').style.visibility = 'visible';
        document.getElementById('cancel-attendance').style.visibility = 'hidden';
        document.getElementById('save-attendance').style.visibility = 'hidden';

        $("#student-rows").html("");

        btn_count = 1;
    });





});


// fuctions 




function modal_view_students(stud_id) {

    $.ajax({
        type: "POST",
        url: "admin.php",
        data: {
            'student_checking_view': true,
            'stud_id': stud_id,
        },
        success: function (response) {
            $.each(response, function (key, studview) {

                $('.student_id_view').text(studview['ID']);
                $('.student_name_view').text(studview['Name']);
                $('.student_father_view').text(studview['Father_Name']);
                $('.student_dob_view').text(studview['DOB']);
                $('.student_bg_view').text(studview['Blood_Group']);
                $('.student_cnic_view').text(studview['CNIC']);
                $('.student_gender_view').text(studview['Gender']);
                $('.student_contact_view').text(studview['Contact']);
                $('.student_batch_view').text(studview['Batch']);
                $('.student_sem_view').text(studview['Semester']);
                $('.student_dept_view').text(studview['Department']);
                $('.student_deg_view').text(studview['Degree']);
                $('.student_mail_view').text(studview['Email']);
                $('.student_reg_view').text(studview['Registration']);
                $("#Student_image").attr('src', studview['Picture']);
            });
            $('#Student_view_modal').modal('show');
        }
    });


}



function modal_edit_students(stud_id) {

    $.ajax({
        type: "POST",
        url: "admin.php",
        data: {
            'student_checking_edit': true,
            'stud_id': stud_id,
        },
        success: function (response) {
            $.each(response, function (key, stud_edit) {

                $('#student_id_edit').val(stud_edit['ID']);
                $('#student_name_edit').val(stud_edit['Name']);
                $('#student_father_edit').val(stud_edit['Father_Name']);
                $('#student_dob_edit').val(stud_edit['DOB']);
                $('#student_bg_edit').val(stud_edit['Blood_Group']);
                $('#student_cnic_edit').val(stud_edit['CNIC']);
                $('#student_gender_edit').val(stud_edit['Gender']);
                $('#student_contact_edit').val(stud_edit['Contact']);
                $('#student_batch_edit').val(stud_edit['Batch']);
                $('#student_sem_edit').val(stud_edit['Semester']);
                $('#student_dept_edit').val(stud_edit['Department']);
                $('#student_deg_edit').val(stud_edit['Degree']);
                $('#student_mail_edit').val(stud_edit['Email']);
                $('#student_reg_edit').val(stud_edit['Registration']);

            });
            $('#Student_edit_modal').modal('show');
        }
    });



}


function modal_view_teachers(teacher_id) {

    $.ajax({
        type: "POST",
        url: "admin.php",
        data: {
            'teacher_checking_view': true,
            'teacher_id': teacher_id,
        },
        success: function (response) {
            $.each(response, function (key, teachview) {

                $('.teacher_id_view').text(teachview['ID']);
                $('.teacher_name_view').text(teachview['Name']);
                $('.teacher_father_view').text(teachview['Father_Name']);
                $('.teacher_dob_view').text(teachview['DOB']);
                $('.teacher_bg_view').text(teachview['Blood_Group']);
                $('.teacher_cnic_view').text(teachview['CNIC']);
                $('.teacher_gender_view').text(teachview['Gender']);
                $('.teacher_contact_view').text(teachview['Contact']);
                $('.teacher_department_view').text(teachview['Department']);
                $('.teacher_designation_view').text(teachview['Designation']);
                $('.teacher_salary_view').text(teachview['Salary']);
                $('.teacher_mail_view').text(teachview['Email']);
                $('.teacher_reg_view').text(teachview['Registration']);
                $("#teacher_image").attr('src', teachview['Picture']);
            });
            $('#teacher_view_modal').modal('show');
        }
    });


}


function modal_edit_teachers(teacher_id) {
    $.ajax({
        type: "POST",
        url: "admin.php",
        data: {
            'teacher_checking_edit': true,
            'teacher_id': teacher_id,
        },
        success: function (response) {
            $.each(response, function (key, teacher_edit) {

                $('#teacher_id_edit').val(teacher_edit['ID']);
                $('#teacher_name_edit').val(teacher_edit['Name']);
                $('#teacher_father_edit').val(teacher_edit['Father_Name']);
                $('#teacher_dob_edit').val(teacher_edit['DOB']);
                $('#teacher_bg_edit').val(teacher_edit['Blood_Group']);
                $('#teacher_cnic_edit').val(teacher_edit['CNIC']);
                $('#teacher_gender_edit').val(teacher_edit['Gender']);
                $('#teacher_contact_edit').val(teacher_edit['Contact']);
                $('#teacher_salary_edit').val(teacher_edit['Salary']);
                $('#teacher_designation_edit').val(teacher_edit['Designation']);
                $('#teacher_department_edit').val(teacher_edit['Department']);
                $('#teacher_mail_edit').val(teacher_edit['Email']);
                $('#teacher_reg_edit').val(teacher_edit['Registration']);
                console.log(teacher_edit['Salary']);

            });
            $('#teacher_edit_modal').modal('show');
        }
    });



}






function modal_edit_courses(course_id) {

    $.ajax({
        type: "POST",
        url: "admin.php",
        data: {
            'course_checking_edit': true,
            'course_id': course_id,
        },
        success: function (response) {
            $.each(response, function (key, course_edit) {

                $('#course_id_edit').val(course_edit['ID']);
                $('#course_name_edit').val(course_edit['Name']);
                $('#course_sem_edit').val(course_edit['Semester']);

            });
            $('#course_edit_modal').modal('show');
        }
    });

}

function attendance_view(course_id) {

    $.ajax({
        type: "POST",
        url: "../PHP/student.php",
        data: {
            'attendence_checking_view': true,
            'course_id': course_id,
        },
        success: function (response) {
            var serial_count = 1;
            $("#attendance_model_details").html("");


            $.each(response, function (key, attendenceview) {
                $('#attendance_model_details').append(
                    "<tr>" + "<td>" + serial_count + "</td> " + "<td>" + attendenceview['Date'] + "</td> " + "<td>" + attendenceview['Status'] + "  </td> " + "</tr> ")
                serial_count++;
            });
            $('#attendance_view_modal').modal('show');
        }
    });


}


// get date wise attendance modal 

function get_date_attendance(att_date,course_id,sec){

    
    $.ajax({
        type: "POST",
        url: "../PHP/teacher.php",
        data: {
            'attendence_date_edit': true,
            'date': att_date,
            'CID': course_id,
            'section': sec,
        },
        success: function (response) {
            $("#edit-student-rows").html("");

                $.each(response, function (key, stud_attendance) {
                
                $("#edit-student-rows").append(     
                "<tr class='text-center'>" +
                "<td id=" + "edit_att_date" + varObj2.a + ">" + stud_attendance['Date'] + "</td >" +
                "<td id=" + "edit_att_SID" + varObj2.a + ">" + stud_attendance['SID'] + "</td>" +
                "<td> <select id=" + "edit_att_status" + varObj.a + " class='p-0 border-0'>" +
                "<option value='P'> P </option>" +
                "<option value='A'> A </option>" +
                "<option value='L'> L </option>" +
                "</select>  </td>" +
                "</tr>"
                )
                $("#edit_att_status"+varObj2.a ).val(stud_attendance['Status']);
                  varObj2.a++;
            });
           $('#attendance_edit_modal').modal('show');
        }

    });



}



function edit_attendance() {
    var data = $('#edit-att').serializeArray();

    $.ajax({
        type: "POST",
        url: "../PHP/teacher.php",
        data: {
            'attendence_checking_edit': true,
            'data': data,
        },
        success: function (response) {
           
            $("#get_course_attendance").html("");

            $.each(response, function (key, stud_attendance) {

                $('#get_course_attendance').append(
                 "<tr>"+
                    "<td class='att_Date'>"+ stud_attendance['Date'] +"</td>"+
                    "<td class='Course_ID' >"+ stud_attendance['CID'] +"</td>"+
                    " <td class='Section' >"+ stud_attendance['Section'] +"</td>"+ 
                    "<td>" +                                                     
                      "<a href="+"'#'"+" id='attendance_edit_btn' class='badge btn-primary  mx-1'"+">Edit</a>"+
                      "<a href="+"'#'"+"class="+"'badge btn-danger attendance_delete_btn'"+">Delete</a>"+
                    "</td>"+
                 "</tr>");
            });
 
 
        }
    });


}


function update_attendance(varObj2,att_date, course_id,sec){
var student_count = varObj2.a;
    var SIDs = [];
    var stat = [];
    
    for (var i = 0; i < student_count; i++) {
        SIDs.push($("#edit_att_SID" + i).text());
        stat.push($("#edit_att_status" + i).val());
    }

   
   $.ajax({
        type: 'POST',
        url: "../PHP/teacher.php",
        data: {
            'attendance_update': true,
            'attendance_date': att_date,
            'attendance_id': course_id,
            'section':sec,
            'SIDs': SIDs,
            'status': stat,
        },
        success: function (response) {
       

        }

    });






    varObj2.a=0;

}





function delete_attendance(att_date, course_id,sec )
{
   

    $.ajax({
        type: 'POST',
        url: "../PHP/teacher.php",
        data: {
            'attendance_delete': true,
            'attendance_date': att_date,
            'attendance_id': course_id,
            'section':sec,
        },
        success: function (response) {


        }
    });


}




function add_courses() {
    var data = $('#c-add').serializeArray();
  
    $.ajax({
        type: "POST",
        url: "admin.php",
        data: {
            'add_course_submit': true,
            'course_data':data,   
        },
        success: function (response) {
          
            if(response == 0){
                $('.add_course_msg').html("");
                $('.add_course_msg').css('color', 'red');

                $('.add_course_msg').append(
                    "<strong>Course ID already exists!</strong>Choose another Cousre ID .</div>"
                );

            }
            else {
                $('.add_course_msg').html("");
                $('.add_course_msg').css('color', 'green');

                $('.add_course_msg').append(
                    "<strong>Success!</strong> Course successfully Registered.</div>"
                );
              
            }

        }
    });


}



function get_students_info(btn_count, varObj) {
    var data = $('#stb').serialize();
    $.ajax({
        type: 'GET',
        url: "../PHP/teacher.php",
        data: data,
        success: function (response) {


            $.each(response, function (key, stud_list) {


                if (btn_count) {
                    document.getElementById('cancel-attendance').style.visibility = 'visible';
                    document.getElementById('save-attendance').style.visibility = 'visible';
                    document.getElementById('get-students').style.visibility = 'hidden';
                    $("#student-rows").html("");

                    btn_count--;
                }

                $("#student-rows").append(
                    "<tr class='text-center'>" +
                    "<td id=" + "add_att_sid" + varObj.a + ">" + stud_list['SID'] + "</td >" +
                    "<td id=" + "add_att_name" + varObj.a + ">" + stud_list['Stu_name'] + "</td>" +
                    "<td> <select id=" + "add_att_status" + varObj.a + " class='p-0 border-0'>" +
                    "<option value='P'> P </option>" +
                    "<option value='A'> A </option>" +
                    "<option value='L'> L </option>" +
                    "</select>  </td>" +

                    "</tr>"

                );
                varObj.a++;

            });
        }

    });


}

function assign_course_teacher() {

    var course_teacher_id = $('#course_id_assign option:selected').text();
    var assign_teacher_id = $('#teacher_id_assign option:selected').text();
    var course_sec_id = $('#assign_sec option:selected').text();
    $.ajax({
        type: "POST",
        url: "admin.php",
        data: {
            'assign_checking_submit': true,
            'course_teacher_id': course_teacher_id,
            'assign_teacher_id': assign_teacher_id,
            'course_sec_id': course_sec_id,
        },
        success: function (response) {
            if (response == 0) {
                $('.assign_course_msg').html("");
                $('.assign_course_msg').css('color', 'red');

                $('.assign_course_msg').append(
                    "<strong>Section already exists!</strong>Choose some other section.</div>"
                );
            } else {
                $('.assign_course_msg').html("");
                $('.assign_course_msg').css('color', 'green');

                $('.assign_course_msg').append(
                    "<strong>Success!</strong> Teacher successfully assigned.</div>"
                );
            }

        }
    });

}

function edit_course_teacher() {

    var course_teacher_id = $('#course_id_assign_edit').val();
    var assign_teacher_id = $('#teacher_id_assign_edit option:selected').text();
    var course_sec_id = $('#assign_sec_edit option:selected').text();
    $.ajax({
        type: "POST",
        url: "admin.php",
        data: {
            'assign_checking_edit': true,
            'course_teacher_id_edit': course_teacher_id,
            'assign_teacher_id_edit': assign_teacher_id,
            'course_sec_id_edit': course_sec_id,
            'old_sec': old_sec,
            'old_teacher': old_teacher,
        },
        success: function (response) {
            if (response == 0) {
                $('.edit_course_msg').html("");
                $('.edit_course_msg').css('color', 'red');

                $('.edit_course_msg').append(
                    "<strong>Section already exists!</strong>Choose some other section.</div>"
                );
            } else {
                $('.edit_course_msg').html("");
                $('.edit_course_msg').css('color', 'green');

                $('.edit_course_msg').append(
                    "<strong>Success!</strong> Teacher successfully Updated.</div>"
                );
            }


        }
    });

}

function delete_course_teacher() {

    $.ajax({
        type: "POST",
        url: "admin.php",
        data: {
            'assign_checking_del': true,
            'del_old_sec': del_old_sec,
            'del_old_teacher': del_old_teacher,
            'course_old_id': course_old_id,
        },
        success: function (response) { }
    });

}

function change_password() {

    var user_pass_id = $('#id_pass').val();
    var user_old_pass = $('#check_pass_old').val();
    var user_new_pass = $('#check_pass_new').val();

    if (user_old_pass != "" && user_new_pass != "") {
        $.ajax({
            type: "POST",
            url: "admin.php",
            data: {
                'check_pass_change': true,
                'user_pass_id': user_pass_id,
                'user_old_pass': user_old_pass,
                'user_new_pass': user_new_pass,
            },
            success: function(response) {
                if (response == 0) {
                    $('.pass_error').html("");
                    $('.pass_error').css('color', 'red');

                    $('.pass_error').append(
                        "<strong>Error!</strong> Old password is incorrect!</div>"
                    );
                } else {
                    $('.pass_error').html("");
                    $('.pass_error').css('color', 'green');

                    $('.pass_error').append(
                        "<strong>Success!</strong> Password successfully Updated.</div>"
                    );
                }


            }
        });
    } else {
        $('.pass_error').html("");
        $('.pass_error').css('color', '#EDB400');

        $('.pass_error').append(
            "<strong>Warning!</strong> Fill all required fields!.</div>"
        );

    }

}




function save_attendance(varObj) {
    var student_count = varObj.a;
    var attendance_date = $('#att-date').val();
    var attendance_course = $('#checkme').val();
    var SIDs = [];
    var names = [];
    var stat = [];
    for (var i = 0; i < student_count; i++) {
        SIDs.push($("#add_att_sid" + i).text());
        names.push($("#add_att_name" + i).text());
        stat.push($("#add_att_status" + i).val());
    }
    $.ajax({
        type: 'POST',
        url: "../PHP/teacher.php",
        data: {
            'attendance_run': 1,
            'attendance_date': attendance_date,
            'attendance_course': attendance_course,
            'SIDs': SIDs,
            'names': names,
            'status': stat,
        },
        success: function (response) {
            if (response) {
                document.getElementById('cancel-attendance').style.visibility = 'hidden';
                document.getElementById('save-attendance').style.visibility = 'hidden';
                document.getElementById('get-students').style.visibility = 'visible';
            }
        }

    });

   
    varObj.a=0;


}