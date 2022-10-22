<?php
function show_my_modal($content = '', $id = '', $data = '', $size = 'md')
{
    $CI = &get_instance();

    if ($content != '') {
        $view_content = $CI->load->view($content, $data, TRUE);

        return '<div class="modal fade bd-example-modal-lg" id="' . $id . '">
                <div class="modal-dialog modal-' . $size . '">
                    <div class="modal-content">
                        ' . $view_content . '
                    </div>
                </div>
                </div>';
    }
}

function getCodeCategory()
{
    $CI         = &get_instance();
    $query      = $CI->db->query("SELECT category.id AS id FROM category ORDER BY SUBSTRING(category.id, 4) DESC LIMIT 1");
    $result     = $query->row();
    return $result;
}

function getCodeProduct($id_category)
{
    $CI         = &get_instance();
    $query      = $CI->db->query("SELECT product.id AS id FROM product WHERE product.id_category = '$id_category' ORDER BY product.id DESC LIMIT 1");
    $result     = $query->row();
    return $result;
}

function getStore()
{
    $CI         = &get_instance();
    $query      = $CI->db->query("SELECT store.id AS id_store, store.name AS name_store FROM store");
    $result     = $query->result_array();
    return $result;
}

function getStoreName($id)
{
    $CI         = &get_instance();
    $query      = $CI->db->query("SELECT store.id AS id_store, store.name AS name_store FROM store WHERE store.id = '$id'");
    $result     = $query->row();
    return $result;
}

function getMonth()
{
    $data_month = [
        '1' => 'January',
        '2' => 'February',
        '3' => 'March',
        '4' => 'April',
        '5' => 'May',
        '6' => 'June',
        '7' => 'July',
        '8' => 'August',
        '9' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December',
    ];

    return $data_month;
}

function getNameDay()
{
    $data_day = [
        '1'     => 'Sunday',
        '2'     => 'Monday',
        '3'     => 'Tuesday',
        '4'     => 'Wednesday',
        '5'     => 'Thursday',
        '6'     => 'Friday',
        '7'     => 'Saturday',

    ];

    return $data_day;
}

function getHour()
{
    $data_hour = [];
    for ($i = 0; $i < 24; $i++) {
        array_push($data_hour, $i);
    }

    return $data_hour;
}

function hashEncrypt($input)
{
    $hash   = password_hash($input, PASSWORD_DEFAULT);
    return $hash;
}

function hashEncryptVerify($input, $hash)
{
    if (password_verify($input, $hash)) {
        return true;
    } else {
        return false;
    }
}

function api_key_xendit()
{
    return 'xnd_development_GC71mv7ZSi23rt1Xb41yDzEBKuiqwO8pEZQpc210MYeLQcK75jyuEq3kMTzm0W';
}

function index_name_day($day_name)
{
    switch ($day_name) {
        case 'Sunday':
            $index = 1;
            break;

        case 'Monday':
            $index = 2;
            break;

        case 'Tuesday':
            $index = 3;
            break;

        case 'Wednesday':
            $index = 4;
            break;

        case 'Thursday':
            $index = 5;
            break;

        case 'Friday':
            $index = 6;
            break;

        case 'Saturday':
            $index = 7;
            break;
        default:
            break;
    }

    return $index;
}
