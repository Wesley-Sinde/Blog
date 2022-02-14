    var url = '{{ $data['url'] }}';
    var flag = false;
    var reg_no = $('input[name="reg_no"]').val();
    var reg_start_date = $('input[name="reg_start_date"]').val();
    var reg_end_date = $('input[name="reg_end_date"]').val();
    var faculty = $('select[name="faculty"]').val();
    var semester_select = $('select[name="semester_select"]').val();
    var batch = $('select[name="batch"]').val();
    var academic_status = $('select[name="academic_status"]').val();
    var status = $('select[name="status"]').val();

    var religion = $('input[name="religion"]').val();
    var caste = $('input[name="caste"]').val();
    var nationality = $('input[name="nationality"]').val();
    var mother_tongue = $('input[name="mother_tongue"]').val();

    if (reg_no !== '') {
        url += '?reg_no=' + reg_no;
        flag = true;
    }

    if (reg_start_date !== '') {
        if (flag) {
            url += '&reg_start_date=' + reg_start_date;
        } else {
            url += '?reg_start_date=' + reg_start_date;
            flag = true;
        }
    }

    if (reg_end_date !== '') {
        if (flag) {
            url += '&reg_end_date=' + reg_end_date;
        } else {
            url += '?reg_end_date=' + reg_end_date;
            flag = true;
        }
    }

    if (faculty >0) {
        if (flag) {
            url += '&faculty=' + faculty;
        } else {
            url += '?faculty=' + faculty;
            flag = true;
        }
    }

    if (semester_select > 0) {
        if (flag) {
            url += '&semester_select=' + semester_select;
        } else {
            url += '?semester_select=' + semester_select;
            flag = true;
        }
    }

    if (batch > 0) {
        if (flag) {
            url += '&batch=' + batch;
        } else {
            url += '?batch=' + batch;
            flag = true;
        }
    }

    if (status !=='all') {
        if (flag) {
        url += '&status=' + status;
        } else {
        url += '?status=' + status;
        flag = true;
        }
    }

    if (academic_status >0) {
        if (flag) {
            url += '&academic_status=' + academic_status;
        } else {
            url += '?academic_status=' + academic_status;
        }
    }

    if (religion !== '') {
        if (flag) {
            url += '&religion=' + religion;
        } else {
            url += '?religion=' + religion;
            flag = true;
        }
    }

    if (caste !== '') {
        if (flag) {
            url += '&caste=' + caste;
        } else {
            url += '?caste=' + caste;
            flag = true;
        }
    }

    if (nationality !== '') {
        if (flag) {
            url += '&nationality=' + nationality;
        } else {
            url += '?nationality=' + nationality;
            flag = true;
        }
    }

    if (mother_tongue !== '') {
        if (flag) {
            url += '&mother_tongue=' + mother_tongue;
        } else {
            url += '?mother_tongue=' + mother_tongue;
            flag = true;
        }
    }
