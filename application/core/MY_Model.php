<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{

    protected $table    = '';
    protected $perPage  = 5;

    public function __construct()
    {
        parent::__construct();
        if (!$this->table) {
            $this->table = strtolower(
                str_replace('_model', '', get_class($this))
            );
        }
    }

    /**
     * Fungsi Validasi Input
     * Rules akan dideklarasikan pada masing-masing model
     * 
     * @return void
     */
    public function validate()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters(
            '<small class="form-text text-danger">',
            '</small>'
        );
        $validationRules = $this->getValidationRules();
        $this->form_validation->set_rules($validationRules);


        return $this->form_validation->run();
    }

    public function validate2()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters(
            '<small class="form-text text-danger">',
            '</small>'
        );
        $validationRules = $this->getValidationRules2();
        $this->form_validation->set_rules($validationRules);


        return $this->form_validation->run();
    }

    public function validate_change_pass()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters(
            '<small class="form-text text-danger">',
            '</small>'
        );
        $validationRules = $this->getValidationRulesChangePass();
        $this->form_validation->set_rules($validationRules);


        return $this->form_validation->run();
    }

    public function validate_variant_product()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters(
            '<small class="form-text text-danger">',
            '</small>'
        );
        $validationRules = $this->getValidationVariantRules();
        $this->form_validation->set_rules($validationRules);


        return $this->form_validation->run();
    }

    public function select($columns)
    {
        $this->db->select($columns);
        return $this;
    }

    public function where($column, $condition)
    {
        $this->db->where($column, $condition);
        return $this;
    }

    public function orWhere($column, $condition)
    {
        $this->db->or_where($column, $condition);
        return $this;
    }

    public function whereIn($column, $condition)
    {
        $this->db->where_in($column, $condition);
        return $this;
    }

    public function whereArr($array)
    {

        $this->db->where($array);
        return $this;
    }

    public function whereMt($array, $condition)
    {
        $this->db->where_in($condition, $array);
        return $this;
    }

    public function like($column, $condition)
    {
        $this->db->like($column, $condition);
        return $this;
    }

    public function orLike($column, $condition)
    {
        $this->db->or_like($column, $condition);
        return $this;
    }

    public function join($table, $type = 'left')
    {
        $this->db->join($table, "$this->table.id_$table = $table.id", $type);
        return $this;
    }

    public function joinUser()
    {
        $this->db->join('user', "transaction.id_user = user.id", 'inner');
        return $this;
    }

    public function join2($table, $type = 'left')
    {
        $this->db->join($table, "$this->table.id = $table.id_$this->table", $type);
        return $this;
    }

    public function join_items_detail_to_product()
    {
        $this->db->join('product', 'items_detail.id_product = product.id', 'left');
        return $this;
    }

    public function joinPegawai($table, $type = 'left')
    {
        $this->db->join($table, "$this->table.nip_$table = $table.nip", $type);
        return $this;
    }
    public function xjoin($table, $type = 'left')
    {
        $this->db->join($table, "$this->table.id = $table.id_$this->table");
        return $this;
    }

    public function joinAlt($table, $table2, $type = 'left')
    {
        $this->db->join($table, "$table2.id = $table.id_$table2");
        return $this;
    }

    public function joinAlt2($table, $table2, $type = 'left')
    {
        $this->db->join($table, "$table2.id_$table = $table.id");
        return $this;
    }
    public function inner_join($table, $type = 'inner')
    {
        $this->db->join($table, "$this->table.id_$table = $table.id", $type);
        return $this;
    }

    public function joinTransaction($table, $type = 'left')
    {
        $this->db->join($table, "$this->table.invoice_$table = $table.invoice", $type);
        return $this;
    }

    public function joinRefund($table, $type = 'left')
    {
        $this->db->join($table, "$this->table.invoice_$table = $table.invoice", $type);
        return $this;
    }

    public function joinProduct()
    {
        $this->db->join('product', "product.id_category = category.id", 'left');
        return $this;
    }



    public function joinBetweenTransaction($table = 'transaction', $table2 = 'transaction_detail', $type = 'inner')
    {
        $this->db->join($table, "$table2.invoice_$table = $table.invoice", $type);
        return $this;
    }

    public function joinBetweenCustomer($table = 'transaction', $table2 = 'customer', $type = 'inner')
    {
        $this->db->join($table, "$table2.id = $table.id_customer", $type);
        return $this;
    }

    public function joinBetweenProductInTransaction($table = 'product_in', $table2 = 'transaction_detail', $type = 'left')
    {
        $this->db->join($table, "$table2.id_product = $table.id_product", $type);
        return $this;
    }



    public function orderBy($column, $order = 'asc')
    {
        $this->db->order_by($column, $order);
        return $this;
    }

    public function groupBy($column)
    {
        $this->db->group_by($column);

        return $this;
    }

    public function first()
    {
        return $this->db->get($this->table)->row();
    }

    public function get()
    {
        return $this->db->get($this->table)->result();
    }

    public function get_array()
    {
        return $this->db->get($this->table)->result_array();
    }

    public function count()
    {
        return $this->db->count_all_results($this->table);
    }

    public function num_rows()
    {
        return $this->db->get($this->table)->num_rows();
    }


    public function create($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function add($data)
    {
        $this->db->insert($this->table, $data);
        return true;
    }

    public function add_batch($data)
    {
        $this->db->insert_batch($this->table, $data);
        return true;
    }

    public function update($data)
    {
        return $this->db->update($this->table, $data);
    }

    public function update_batch($data, $key)
    {
        return $this->db->update_batch($this->table, $data, $key);
    }

    public function delete()
    {
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    public function muldel($field, $value)
    {
        $this->db->where_in($field, $value);
        $this->db->delete($this->table);

        return $this->db->affected_rows();
    }

    public function paginate($page)
    {
        $this->db->limit(
            $this->perPage,
            $this->calculateRealOffset($page)
        );

        return $this;
    }

    public function limit($page)
    {
        $this->db->limit($page);

        return $this;
    }

    public function limit_data($start, $page)
    {
        $this->db->limit($page, $start);

        return $this;
    }

    public function calculateRealOffset($page)
    {
        if (is_null($page) || empty($page)) {
            $offset = 0;
        } else {
            $offset = ($page * $this->perPage) - $this->perPage;
        }

        return $offset;
    }

    public function makePagination($baseUrl, $uriSegment, $totalRows = null)
    {
        $this->load->library('pagination');

        $config = [
            'base_url'          => $baseUrl,
            'uri_segment'       => $uriSegment,
            'per_page'          => $this->perPage,
            'total_rows'        => $totalRows,
            'use_page_numbers'  => true,

            'full_tag_open'     => '<ul class="pagination justify-content-center">',
            'full_tag_close'    => '</ul>',
            'attributes'        => ['class' => 'page-link'],
            'first_link'        => false,
            'last_link'         => false,
            'first_tag_open'    => '<li class="page-item">',
            'first_tag_close'   => '</li>',
            'prev_link'         => '&laquo',
            'prev_tag_open'     => '<li class="page-item">',
            'prev_tag_close'    => '</li>',
            'next_link'         => '&raquo',
            'next_tag_open'     => '<li class="page-item">',
            'next_tag_close'    => '</li>',
            'last_tag_open'     => '<li class="page-item">',
            'last_tag_close'    => '</li>',
            'cur_tag_open'      => '<li class="page-item active"><span class="page-link">',
            'cur_tag_close'     => '<span class="sr-only">(current)</span></span></li>',
            'num_tag_open'      => '<li class="page-item">',
            'num_tag_close'     => '</li>',
            'first_link'        => 'First',
            'last_link'         => 'Last'
        ];


        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }
}

/* End of file MY_Model.php */
