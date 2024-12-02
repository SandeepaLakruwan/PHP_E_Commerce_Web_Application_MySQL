<?php
session_start();
include "Database.php";

$email = $_POST["e"];

$chat_rs = Connection::select("SELECT * FROM `chat` WHERE `from`='" . $email . "'");
$chat_num = $chat_rs->num_rows;

if ($chat_num != 0) {
    for ($i = 0; $i < $chat_num; $i++) {
        $chat_data = $chat_rs->fetch_assoc();

        if ($chat_data["status"] == "3" || $chat_data["status"] == "4") {
?>
            <!-- sent -->
            <div class="col-12 mt-2">
                <div class="row">
                    <div class="offset-4 col-8 rounded bg-primary bg-opacity-50">
                        <div class="row">
                            <div class="col-12 pt-2">
                                <span class="text-dark fs-5"><?php echo $chat_data["content"] ?></span>
                            </div>
                            <div class="col-12 text-end pb-2">
                                <span class="text-white"><?php echo $chat_data["date_time"] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sent -->
        <?php
        } else if ($chat_data["status"] == "1") {
            Connection::iud("UPDATE `chat` SET `status`='2' WHERE `chat_id`='".$chat_data["chat_id"]."'");
        ?>
            <!-- received -->
            <div class="col-12 mt-2">
                <div class="row">
                    <div class="col-8 rounded bg-success bg-opacity-50">
                        <div class="row">
                            <div class="col-12 pt-2">
                                <span class="text-dark fs-5"><?php echo $chat_data["content"] ?></span>
                            </div>
                            <div class="col-12 text-end pb-2">
                                <span class="text-white"><?php echo $chat_data["date_time"] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- received -->
<?php
        }else if($chat_data["status"] == "2"){
            ?>
            <!-- received -->
            <div class="col-12 mt-2">
                <div class="row">
                    <div class="col-8 rounded bg-success bg-opacity-50">
                        <div class="row">
                            <div class="col-12 pt-2">
                                <span class="text-dark fs-5"><?php echo $chat_data["content"] ?></span>
                            </div>
                            <div class="col-12 text-end pb-2">
                                <span class="text-white"><?php echo $chat_data["date_time"] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- received -->
<?php
        }
    }
}

?>