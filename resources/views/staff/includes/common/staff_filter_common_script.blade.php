    var url = '{{ $data['url'] }}';
    var flag = false;
    var reg_no = $('input[name="reg_no"]').val();
    var designation = $('select[name="designation"]').val();
    var status = $('select[name="status"]').val();
    var join_date_start = $('input[name="join_date_start"]').val();
    var join_date_end = $('input[name="join_date_end"]').val();

    if (reg_no !== '') {
        url += '?reg_no=' + reg_no;
        flag = true;
    }

    if (join_date_start !== '') {

        if (flag) {

            url += '&join_date_start=' + join_date_start;

        } else {

            url += '?join_date_start=' + join_date_start;
            flag = true;

        }
    }

    if (join_date_end !== '') {

        if (flag) {

            url += '&join_date_end=' + join_date_end;

        } else {

            url += '?join_date_end=' + join_date_end;
            flag = true;

        }
    }

    if (designation !== '' && designation > 0 ) {

        if (designation !== 'all') {

            if (flag) {

                url += '&designation=' + designation;

            } else {

                url += '?designation=' + designation;

            }

        }
    }

    if (status !== '' ) {

        if (status !== 'all') {

            if (flag) {

                url += '&status=' + status;

            } else {

                url += '?status=' + status;

            }

        }
    }
