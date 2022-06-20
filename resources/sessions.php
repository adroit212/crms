<?php

class Sessions {

    private $gateway_email = "******"; ////your bulksmslive registered email
    private $gateway_password = "*****"; //Your bulksmslive password
    private $gateway_senderID = "New Message"; //Your sender name (ID)
    public $APP_TITLE = "Customer Relation Management";
    public $APP_SYMBOL = "C.R.M";
    private $DB_USER = "root";
    private $DB_PASSWORD = "";
    private $DB_DSN = "mysql:host=localhost;dbname=crms";

    private function getConnection() { //create database connection
        try {
            $conn = new PDO($this->DB_DSN, $this->DB_USER, $this->DB_PASSWORD);
            return $conn;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function login($username, $password) {
        try {
            $conn = $this->getConnection();
            $role = NULL;
            $query = "SELECT * FROM login WHERE userid=? AND password=?;";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $username);
            $ps->bindParam(2, $password);
            $ps->execute();
            $res = $ps->fetchAll();
            foreach ($res as $r) {
                $role = $r['role'];
            }
            return $role;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function newLogin($email, $roletype) {
        try {
            $conn = $this->getConnection();
            $result = FALSE;
            if ($this->getSingleCustomer($email) == NULL) {
                $reg_date = date("Y-m-d H:i:s");
                $query = "INSERT INTO login VALUES(?,?,?)";
                $ps = $conn->prepare($query);
                $ps->bindParam(1, $email);
                $ps->bindParam(2, $email);
                $ps->bindParam(3, $roletype);
                $result = $ps->execute();
            }
            return $result;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getSingleLogin($email) {
        try {
            $conn = $this->getConnection();
            $query = "SELECT * FROM login WHERE userid = ?";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $email);
            $ps->execute();
            $result = $ps->fetchAll();
            $res = NULL;
            foreach ($result as $r) {
                $res = $r;
            }
            return $res;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getLoginByType($roletype) {
        try {
            $conn = $this->getConnection();
            $query = "SELECT * FROM login WHERE role = ?";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $roletype);
            $ps->execute();
            return $ps->fetchAll();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function removeLoginByID($email) {
        try {
            $conn = $this->getConnection();
            $query = "DELETE FROM login WHERE userid = ?";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $email);
            return $ps->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function newCustomer($email, $mobile, $fullname) {
        try {
            $conn = $this->getConnection();
            $result = FALSE;
            if ($this->getSingleCustomer($email) == NULL) {
                $reg_date = date("Y-m-d H:i:s");
                $query = "INSERT INTO customer VALUES(?,?,?,?)";
                $ps = $conn->prepare($query);
                $ps->bindParam(1, $email);
                $ps->bindParam(2, $mobile);
                $ps->bindParam(3, $fullname);
                $ps->bindParam(4, $reg_date);
                $result = $ps->execute();
            }
            return $result;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getSingleCustomer($email) {
        try {
            $conn = $this->getConnection();
            $query = "SELECT * FROM customer WHERE email = ?";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $email);
            $ps->execute();
            $result = $ps->fetchAll();
            $res = NULL;
            foreach ($result as $r) {
                $res = $r;
            }
            return $res;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getSingleCustomerMobile($email) {
        try {
            $conn = $this->getConnection();
            $query = "SELECT * FROM customer WHERE email = ?";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $email);
            $ps->execute();
            $result = $ps->fetchAll();
            $res = NULL;
            foreach ($result as $r) {
                $res = $r['mobile'];
            }
            return $res;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getAllCustomers() {
        try {
            $conn = $this->getConnection();
            $query = "SELECT * FROM customer";
            $ps = $conn->prepare($query);
            $ps->execute();
            return $ps->fetchAll();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function removeCustomerByID($email) {
        try {
            $conn = $this->getConnection();
            $query = "DELETE FROM customer WHERE email = ?";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $email);
            return $ps->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function newStaff($email, $mobile, $fullname, $roletype) {
        try {
            $conn = $this->getConnection();
            $result = FALSE;
            if ($this->getSingleLogin($email) == NULL) {
                $reg_date = date("Y-m-d H:i:s");

                $this->newLogin($email, $roletype); //save staff login detail

                $query = "INSERT INTO staff VALUES(?,?,?,?)";
                $ps = $conn->prepare($query);
                $ps->bindParam(1, $email);
                $ps->bindParam(2, $mobile);
                $ps->bindParam(3, $fullname);
                $ps->bindParam(4, $reg_date);
                $result = $ps->execute();
            }
            return $result;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getSingleStaff($email) {
        try {
            $conn = $this->getConnection();
            $query = "SELECT * FROM staff WHERE email = ?";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $email);
            $ps->execute();
            $result = $ps->fetchAll();
            $res = NULL;
            foreach ($result as $r) {
                $res = $r;
            }
            return $res;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getAllStaff() {
        try {
            $conn = $this->getConnection();
            $query = "SELECT * FROM staff";
            $ps = $conn->prepare($query);
            $ps->execute();
            return $ps->fetchAll();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function removeStaffByID($email) {
        try {
            $this->removeLoginByID($email);

            $conn = $this->getConnection();
            $query = "DELETE FROM staff WHERE email = ?";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $email);
            return $ps->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function makeSale($customer, $price, $products, $staff) {
        try {
            $conn = $this->getConnection();
            $reg_date = date("Y-m-d H:i:s");
            $query = "INSERT INTO sales(staff,customer,products,price,issuedate) VALUES(?,?,?,?,?)";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $staff);
            $ps->bindParam(2, $customer);
            $ps->bindParam(3, $products);
            $ps->bindParam(4, $price);
            $ps->bindParam(5, $reg_date);
            $result = $ps->execute();
            return $result;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getSingleSale($orderid) {
        try {
            $conn = $this->getConnection();
            $query = "SELECT * FROM sale WHERE salesid = ?";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $orderid);
            $ps->execute();
            $result = $ps->fetchAll();
            $res = NULL;
            foreach ($result as $r) {
                $res = $r;
            }
            return $res;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getAllSales() {
        try {
            $conn = $this->getConnection();
            $query = "SELECT * FROM sales";
            $ps = $conn->prepare($query);
            $ps->execute();
            return $ps->fetchAll();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function sendPromotions($title, $description, $customers) {
        $date_sent = date("Y-m-d H:i:s");
        $customer = "";
        $mobiles = "";
        $message = $title . ". " . $description;
        if ($customers == "all") {
            $sub_customer = $this->getAllCustomers();
            $flag = TRUE;
            foreach ($sub_customer as $sub_cust) {
                if ($flag) {
                    $flag = FALSE;
                    $customer .= $sub_cust['email'];
                    $mobiles .= $sub_cust['mobile'];
                } else {
                    $customer .= "," . $sub_cust['email'];
                    $mobiles .= "," . $sub_cust['mobile'];
                }
            }
        } else {
            $customer = $customers;
            $mobiles = $this->getSingleCustomerMobile($customers);
        }

        $this->sendSMS($mobiles, $message);

        $conn = $this->getConnection();
        $query = "INSERT INTO promotion(title, description, customers, date_sent) VALUES(?,?,?,?);";
        $ps = $conn->prepare($query);
        $ps->bindParam(1, $title);
        $ps->bindParam(2, $description);
        $ps->bindParam(3, $customer);
        $ps->bindParam(4, $date_sent);
        return $ps->execute();
    }

    public function getAllPromotions() {
        try {
            $conn = $this->getConnection();
            $query = "SELECT * FROM promotion";
            $ps = $conn->prepare($query);
            $ps->execute();
            return $ps->fetchAll();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    //---------------------- Start Bulk SMS Operations ---------------------------
    function sendsms_post($params1) {
        $url = 'https://api.bulksmslive.com/v2/app/sms';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($params1)));
        $result = curl_exec($ch);
        $res_array = json_decode($result);

        return $res_array;
    }

    public function sendSMS($mobiles, $message) {
        try {
            $recipients = $mobiles;
            $data = array("email" => $this->gateway_email,
                "password" => $this->gateway_password,
                "message" => $message,
                "sender_name" => $this->gateway_senderID,
                "recipients" => $recipients,
                "forcednd" => "1");
            $data_string = json_encode($data);
            return $this->sendsms_post($data_string);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        return NULL;
    }

    //---------------------- End Bulk SMS Operations ---------------------------
}
