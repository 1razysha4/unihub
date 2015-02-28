<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends Public_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('template');
        $this->usergroup_id = 3;
        $this->load->model('user_model');
    }

    function login() {

        if ($this->input->is_ajax_request()) {
            $email = $this->input->post('email', true);
            $password = sha1($this->input->post('password', true));
            
            
            $res = $this->user_model->validate($email, $password);
           
            if (isset($res) && is_array($res)) {
                $sessiondata = array(
                    'is_loggedin' => '1',
                    'user_id' => $res[0]
                );
                $this->session->set_userdata($sessiondata);
                echo 'logged_in';
                exit;
            } else {
                echo 'error';
                exit;
            }
        } else {
            if (isset($_POST['login'])) {
                $email = $this->input->post('email', true);
                $password = sha1($this->input->post('password', true));
                $res = $this->user_model->validate($email, $password);
                if (isset($res) && is_array($res)) {
                    $sessiondata = array(
                        'is_loggedin' => '1',
                        'user_id' => $res[0]
                    );
                    $this->session->set_userdata($sessiondata);
                   
                    redirect('user/dashboard', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Invalid email and password');
                    redirect('user/login', 'refresh');
                }
            }
        }
        $data = array('title' => 'Login',);
        $this->load->view('users/login', $data);
    }

    function dashboard() {
        if (@$this->session->userdata['is_loggedin'] == 1) {
           
            $data = array(
                'title' => 'Dashboard'
            );
            $this->load->view('users/dashboard', $data);
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function logout() {
        $this->session->sess_destroy();
        $this->load->helper('url');
        /* $session_data = array('is_admin'=>false);
          $this->session->set_userdata($session_data); */
        redirect('user/login', 'refresh');
    }

    function register() {

        if (isset($_POST['submit'])) {
            $username = $this->input->post('username', true);
            $email = $this->input->post('emailaddress', true);
            $id = $this->user_model->add();
            if ($id) {
                $emaildata = array(
                    'username' => $username,
                    'user_id' => $id,
                    'activation_key' => md5(md5(time() . rand(2, 5)))
                );

                $config = array(
                    // 'protocol' => 'smtp',
                    //       'smtp_host' => 'ssl://smtp.googlemail.com',
                    //       'smtp_port' => 465,
                    //       'smtp_user' => 'neu.santosh@gmail.com',
                    //       'smtp_pass' => '',
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'wordwrap' => TRUE
                );

                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $email_body = $this->load->view('email_templates/new_registration', $emaildata, true);
                $this->email->from('info@collegewaves.com', 'College Waves');


                $this->email->to($email);
                $this->email->subject('User Registered');
                $this->email->message($email_body);

                $this->email->send();
                echo $this->email->print_debugger();
                exit();
            }
            $this->session->set_flashdata('success', 'User Registered successfully.Please check your email address to verify you email address');
            redirect('user/register', 'refresh');
        }
        $data = array('title' => 'Register');

        $this->load->view('users/user_login', $data);
    }

    function activation() {
        $task = $this->uri->segment(2);
        $user_id = $this->uri->segment(3);

        if ($task == 'activation') {
            $this->db->where('id', $user_id);
            $this->db->update('tbl_users', array('status' => 1));

            $this->session->set_flashdata('success', "Your profile has been activated");
            redirect('user/login', 'refresh');
        }
    }

    function resetpassword() {
        $data = array(
            'title' => 'Reset Password'
        );
        $this->load->view('users/reset_password', $data);
    }

    function checkemail() {
        if ($this->input->is_ajax_request()) {
            $emailaddress = $this->input->post('emailaddress', true);
            $res = $this->user_model->checkemailaddress($emailaddress);
            if ($res == false) {
                echo "0";
                exit();
            } else {
                $emaildata = array(
                    'userid' => $res[0]['id'],
                    'username' => $res[0]['username'],
                );

                $config = array(
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'wordwrap' => TRUE
                );

                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $email_body = $this->load->view('email_templates/reset_password', $emaildata, true);
                $this->email->from('info@collegewaves.com', 'College Waves');


                $this->email->to($res[0]['email']);
                $this->email->subject('Reset Your Password');
                $this->email->message($email_body);

                if (!$this->email->send()) {
                    echo "Failed";
                    exit();
                } else {
                    echo '1';
                    exit();
                }
            }
        }
    }

    function forgotpassword() {


        if (isset($_POST['submit'])) {
            $id = $this->input->post('id', true);
            $this->db->where('id', $id);
            $this->db->update('tbl_users', array('password' => sha1($_POST['password']), 'original_password' => $_POST['password']));

            $this->session->set_flashdata('success', 'Password has been updated successfully.Please login form here');
            redirect('user/login', 'refresh');
        }

        $data = array(
            'title' => "Change Password",
            'id' => $this->uri->segment(3)
        );

        $this->load->view('users/forgotpassword', $data);
    }

    /**
     * changes password for logged in user
     */
    function changepassword() {
        if (isset($_POST['submit'])) {
        $userid = $this->input->post('id_user');
            $current_password = $this->input->post('password');
            $new_password = $this->input->post('newpassword');
            $confirm_password = $this->input->post('confirmpassword');
            $result = $this->user_model->changePassword($userid, $new_password, $current_password);
            if ($result) {
                $this->session->set_flashdata('error', 'Password changed successfully');
                redirect('user/dashboard', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Password has not been changed');
                redirect('user/forgot_password', 'refresh');
            }
        } else {

            $data = array('title' => 'Change Password');
            $this->load->view('users/forgot_password', $data);
        }
    }

}
