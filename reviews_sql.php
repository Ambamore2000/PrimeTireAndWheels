<?php

class Reviews_SQL {

    private $db;
    private $count;
    private $average;
    private $reviews;

    public function __construct() {
        $this->db = new SQLite3('reviews.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
        $this->initialize();
        $this->setCount();
        $this->setAverage();
        $this->setReviews();
    }

    private function initialize() {
        $this->db->exec('
        CREATE TABLE IF NOT EXISTS "reviews" (
        "email" VARCHAR(100) PRIMARY KEY NOT NULL,
        "firstName" VARCHAR(50) NOT NULL,
        "lastName" VARCHAR(50),
        "rating" INTEGER NOT NULL,
        "reviewMessage" TEXT NOT NULL,
        "date" DATE NOT NULL)'
        );
    }

    public function getCount() {
        return $this->count;
    }

    public function getAverage() {
        return $this->average;
    }
    public function getReviews() {
        return $this->reviews;
    }

    private function setCount() {
        $count_ratings_sql = $this->db->prepare("SELECT COUNT(email) AS count FROM 'reviews'");
        $count_ratings = $count_ratings_sql->execute();

        $this->count = $count_ratings->fetchArray(SQLITE3_ASSOC)["count"];
    }
    private function setAverage() {
        $average_ratings_sql = $this->db->prepare("SELECT AVG(rating) AS average FROM 'reviews'");
        $average_ratings = $average_ratings_sql->execute();

        $this->average = round($average_ratings->fetchArray(SQLITE3_ASSOC)["average"],2);
    }
    private function setReviews() {
        $reviews_sql = $this->db->prepare("SELECT * FROM 'reviews'");
        $this->reviews = $reviews_sql->execute();
    }

    public function setReviewsDefault($order_rule, $order_order, $filter = null) {
        $query = "SELECT * FROM 'reviews'";

        if ($filter) {
            $query .= " WHERE rating = " . $filter;
        }

        $query .= " ORDER BY " . $order_rule . " " . $order_order;

        $reviews_sql = $this->db->prepare($query);
        $this->reviews = $reviews_sql->execute();
    }

    public function addReview($email, $first_name, $last_name, $rating, $review_message) {
        $exec_string = "INSERT INTO 'reviews' VALUES";
        $exec_string .= "('" . $email . "', '";
        $exec_string .= $first_name . "', '";
        $exec_string .= $last_name . "', '";
        $exec_string .= $rating . "', '";
        $exec_string .= $review_message . "', '";
        $exec_string .= date("Y-n-j") . "')";

        $this->db->exec($exec_string);
    }
}
