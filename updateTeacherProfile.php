<?php

session_start();

require "connection.php";

if (isset($_SESSION["t"])) {
    $teacher_data = $_SESSION["t"]["email"];

    $teacher_rs = Database::search("SELECT * FROM `teacher_registration` 
    INNER JOIN `gender` ON teacher_registration.gender_id=gender.id
    INNER JOIN `teacher_has_subject` ON teacher_registration.email=teacher_has_subject.teacher_registration_email
    INNER JOIN `subject` ON teacher_has_subject.subject_id=subject.id
    INNER JOIN `grade_has_teacher` ON teacher_registration.email=grade_has_teacher.teacher_registration_email
    WHERE `email`='" . $teacher_data . "'");

    $teacher_img_rs = Database::search("SELECT * FROM `teacher_profile_image` WHERE `teacher_registration_email`='" . $teacher_data . "'");

    $teacher_img_data = $teacher_img_rs->fetch_assoc();
    $teacher_data = $teacher_rs->fetch_assoc();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Teacher Profile</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/tempusdominus-bootstrap-4.min.css">
        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="bootstrap.css" />
    </head>

    <body>
        <div class="container-fluid position-relative d-flex p-0">
            <div id="spinner" class="show position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center" style="background-color: #172238;">
                <div class="spinner-border" style="width: 3rem; height: 3rem; color:#f5a425;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="sidebar pe-4 pb-3 admin-dashboard-nav" style="background-color: #172238;">
                <nav class="navbar">
                    <a href="index.html" class="navbar-brand mx-4 mb-3">
                        <h3><em>MY</em>SCHOOL</h3>
                    </a>
                    <div class="d-flex align-items-center ms-4 mb-4">
                        <div class="position-relative">
                            <?php
                            if (empty($teacher_img_data["path"])) {
                            ?>
                                <img class="rounded-circle" src="assets/images/teacherimg.svg" alt="" style="width: 40px; height: 40px;">
                            <?php
                            } else {
                            ?>
                                <img class="rounded-circle" src="<?php echo $teacher_img_data["path"]; ?>" alt="" style="width: 40px; height: 40px;">
                            <?php
                            }
                            ?>
                            <div class="bg-success rounded-circle border border-1 border-white position-absolute end-0 bottom-0 p-1"></div>
                        </div>
                        <div class="ms-4 text-white">
                            <h6 class="mb-0"><?php echo $teacher_data["first_name"] . " " . $teacher_data["last_name"]; ?></h6>
                            <span>Teacher</span>
                        </div>
                    </div>
                    <div class="navbar-nav w-100">
                        <a href="teacherPanel.php" class="nav-item nav-link active"><i class="fa-solid fa-chart-line me-2"></i>Dashboard</a>
                        <a href="teacherLesson.php" class="nav-item nav-link"><i class="fa-solid fa-chalkboard-user me-2"></i>Lessons</a>
                        <a href="#" class="nav-item nav-link"><i class="fa-solid fa-square-poll-vertical me-2"></i>Assingments</a>
                        <a href="#" class="nav-item nav-link" style="font-size: 15px;"><i class="fa-solid fa-square-poll-vertical me-2"></i>Answer Sheets</a>
                        <a href="#" class="nav-item nav-link"><i class="fa-solid fa-square-poll-vertical me-2"></i>Marks</a>
                    </div>
                </nav>
            </div>
            <div class="content">
                <nav class="navbar navbar-expand  sticky-top px-4 py-0" style="background-color: #172238;">
                    <a href="#" class="sidebar-toggler flex-shrink-0 text-decoration-none">
                        <i class="fa fa-bars" style="font-size: 30px;"></i>
                    </a>
                    <form class="d-none d-md-flex ms-4 col-4">
                        <input class="form-control border-0" type="search" placeholder="Search">
                    </form>
                    <div class="navbar-nav align-items-center ms-auto">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-bs-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">
                                    <div>
                                        <h6 class="fw-normal mb-0">message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <div>
                                        <h6 class="fw-normal mb-0">message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <div>
                                        <h6 class="fw-normal mb-0">message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item text-center">See all message</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-bs-toggle="dropdown">
                                <i class="fa fa-bell me-lg-2"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">
                                    <h6 class="fw-normal mb-0">Profile updated</h6>
                                    <small>15 minutes ago</small>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <h6 class="fw-normal mb-0">New user added</h6>
                                    <small>15 minutes ago</small>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <h6 class="fw-normal mb-0">Password changed</h6>
                                    <small>15 minutes ago</small>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item text-center">See all notifications</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-bs-toggle="dropdown">
                                <?php
                                if (empty($teacher_img_data["path"])) {
                                ?>
                                    <img class="rounded-circle" src="assets/images/teacherimg.svg" alt="" style="width: 40px; height: 40px;">
                                <?php
                                } else {
                                ?>
                                    <img class="rounded-circle" src="<?php echo $teacher_img_data["path"]; ?>" alt="" style="width: 40px; height: 40px;">
                                <?php
                                }
                                ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" style="width: 100px;">
                                <a href="#" class="dropdown-item">My Profile</a>
                                <a href="#" class="dropdown-item">Settings</a>
                                <a href="#" class="dropdown-item" onclick="teacherLogOut();">Log Out</a>
                            </div>
                        </div>
                    </div>
                </nav>
                <div class="container-fluid pt-4 px-4">
                    <div class="col-12 row my-profile">
                        <p>My Profile</p>
                    </div>
                    <div class="col-12 row my-profile-2">
                        <div class="col-12 mt-5 mb-3 row">
                            <div class="col-6 d-flex justify-content-center align-items-center">
                                <div class="col-12">
                                    <div class="col-12  d-flex justify-content-center align-items-center">
                                        <?php

                                        if (empty($teacher_img_data["path"])) {
                                        ?>
                                            <img src="assets/images/teacherimg.svg" class="rounded-circle" width="200px" height="200px" id="img">
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo $teacher_img_data["path"]; ?>" class="rounded-circle" width="200px" height="200px" id="img">
                                        <?php
                                        }

                                        ?>
                                    </div>
                                    <div class="col-12  d-flex justify-content-center align-items-center mt-2">
                                        <input type="file" class="d-none" id="profileimg" accept="image/*" />
                                        <label for="profileimg" class="btn btn-primary fw-bold" onclick="addProfileImage();">Change Image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="col-12">
                                    <label class="form-label ps-1 fw-bold">First Name</label>
                                    <input type="text" class="form-control border border-warning" value="<?php echo $teacher_data["first_name"]; ?>" id="fname" />
                                </div>
                                <div class="col-12 mt-4">
                                    <label class="form-label ps-1 fw-bold">Middle Name</label>
                                    <input type="text" class="form-control border border-warning" value="<?php echo $teacher_data["middle_name"]; ?>" id="mname" />
                                </div>
                                <div class="col-12 mt-4">
                                    <label class="form-label ps-1 fw-bold">Last Name</label>
                                    <input type="text" class="form-control border border-warning" value="<?php echo $teacher_data["last_name"]; ?>" id="lname" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="col-12 mt-4">
                                    <div class="col-12 row p-0">
                                        <div class="col-6">
                                            <label class="form-label ps-1 fw-bold">Email</label>
                                            <input type="text" class="form-control border border-warning text-black-50" value="<?php echo $teacher_data["email"]; ?>" id="" disabled />
                                        </div>
                                        <div class="col-6 ps-0">
                                            <label class="form-label ps-1 ms-4 fw-bold">Password</label>
                                            <input type="text" class="form-control border border-warning ms-4 text-black-50" value="<?php echo $teacher_data["password"]; ?>" id="" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="col-12 row p-0">
                                        <div class="col-6">
                                            <label class="form-label ps-1 fw-bold">Mobile</label>
                                            <input type="text" class="form-control border border-warning" value="<?php echo $teacher_data["contact_no"]; ?>" id="mobile" />
                                        </div>
                                        <div class="col-6 ps-0">
                                            <label class="form-label ps-1 ms-4 fw-bold">NIC</label>
                                            <input type="text" class="form-control border border-warning ms-4 text-black-50" value="<?php echo $teacher_data["nic"]; ?>" id="" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="col-12 row p-0">
                                        <div class="col-6">
                                            <label class="form-label ps-1 fw-bold">Subject</label>
                                            <input type="text" class="form-control border border-warning text-black-50" value="<?php echo $teacher_data["subject_name"]; ?>" disabled />
                                        </div>
                                        <div class="col-6 ps-0">
                                            <label class="form-label ps-1 ms-4 fw-bold">Grade</label>
                                            <input type="text" class="form-control border border-warning ms-4 text-black-50" value="<?php echo $teacher_data["grade_id"]; ?>" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="col-12 row p-0">
                                        <div class="col-6">
                                            <label class="form-label ps-1 fw-bold">Gender</label>
                                            <input type="text" class="form-control border border-warning text-black-50" value="<?php echo $teacher_data["gender_name"]; ?>" id="" disabled />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 row mb-4 mt-4">
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <button class="btn btn-success col-8 fw-bold" onclick="updateTeacherProfile();"><i class="bi bi-arrow-up-circle"></i>&nbsp;Update Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/chart.min.js"></script>
        <script src="assets/js/easing.js"></script>
        <script src="assets/js/waypoints.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/moment.min.js"></script>
        <script src="assets/js/moment-timezone.min.js"></script>
        <script src="assets/js/tempusdominus-bootstrap-4.min.js"></script>
        <script src="main.js"></script>
        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="bootstrap.js"></script>
    </body>

    </html>
<?php
} else {
    echo ("admin lognin not validated");
}

?>