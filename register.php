<?php
require_once "config/db_connect.php";
require_once "components/file_upload.php";

session_start();

if (isset($_SESSION["user"])) {
    header("Location: index.php");
}
if (isset($_SESSION["admin"])) {
    header("Location: admin/dashboard.php");
}
function redirect($url, $message, $type = 'success')
{

    $_SESSION['message'] = $message;
    $_SESSION['type'] = $type;
    header("Location: " . $url);
    exit();
}
$fnameError = $lnameError = $emailError = $passError = $confirmPassError = $dateError = $genderError = $stateError = $cityError = $streetError = $zipError = $roleError = $first_name = $last_name = $email =  $street_address = $city = $zip_code = $state = $gender = $userType = $picture = "";
function cleanInput($param)
{
    $clean = trim($param);
    $clean = strip_tags($clean);
    $clean = htmlspecialchars($clean);

    return $clean;
}

$formSubmitted = false;
if (isset($_POST["register"])) {
    $error = false;

    $first_name = cleanInput($_POST["firstName"]);
    $last_name = cleanInput($_POST["lastName"]);
    $email = cleanInput($_POST["email"]);
    $password = cleanInput($_POST["password"]);
    $password1 = cleanInput($_POST["password1"]);
    $date_of_birth = cleanInput($_POST["birthDate"]);
    $street_address = cleanInput($_POST["street"]);
    $city = cleanInput($_POST["city"]);
    $zip_code = cleanInput($_POST["zipCode"]);
    $state = cleanInput($_POST["state"]);

    if (empty($first_name)) {
        $error = true;
        $fnameError = "Please enter your first name";
    } elseif (strlen($first_name) < 3) {
        $error = true;
        $fnameError = "First name must have at least 3 chars";
    } elseif (!preg_match("/^[a-zA-Z]+$/", $first_name)) {
        $error = true;
        $fnameError = "First name must contain only letters and no spaces";
    }

    if (empty($last_name)) {
        $error = true;
        $lnameError = "Please enter your last name";
    } elseif (strlen($last_name) < 3) {
        $error = true;
        $lnameError = "Last name must have at least 3 chars";
    } elseif (!preg_match("/^[a-zA-Z]+$/", $last_name)) {
        $error = true;
        $lnameError = "Last name must contain only letters and no spaces";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email address";
    } else {
        $query = "SELECT email FROM users WHERE email = '$email' ";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) != 0) {
            $error = true;
            $emailError = "Provided Email is already in use.";
        }
    }

    if (empty($date_of_birth)) {
        $error = true;
        $dateError = "Please enter your date of birth.";
    }

    $gender = isset($_POST['gender']) ? cleanInput($_POST['gender']) : "";
    if (empty($gender)) {
        $genderError = "Please select a gender.";
    }


    if (empty($state)) {
        $error = true;
        $stateError = 'Please enter state';
    }
    if (empty($city)) {
        $error = true;
        $cityError = 'Please enter city';
    }
    if (empty($street_address)) {
        $error = true;
        $streetError = 'Please enter street';
    }
    if (empty($zip_code)) {
        $error = true;
        $zipError = 'Please enter zip code';
    }

    // password validation
    if (empty($password)) {
        $error = true;
        $passError = "Please enter password.";
    } elseif (strlen($password) < 6) {
        $error = true;
        $passError = "Password must have at least 6 characters.";
    }
    if (empty($password1)) {
        $error = true;
        $confirmPassError = 'Please confirm your password.';
    } elseif ($password !== $password1) {
        $confirmPassError = 'Passwords do not match.';
    }
    $password = hash("sha256", $password);

    $picture = file_upload($_FILES["picture"], 'edit-profile');
    if (!$error) {
        $sql = "INSERT INTO `address_code`(`city`, `zip_code`, `state`) VALUES ('$city','$zip_code','$state')";
        $res = mysqli_query($connect, $sql);
        $address_code_id = mysqli_insert_id($connect);

        $sql1 = "INSERT INTO `users`(`first_name`, `last_name`, `birth_date`, `gender`, `email`, `password`,  `street_address`,`address_code_id`,`profile_picture`,`user_type`) VALUES ('$first_name', '$last_name','$date_of_birth','$gender','$email','$password','$street_address',' $address_code_id','$picture->fileName','user')";
        $res1 = mysqli_query($connect, $sql1);
        if ($res1) {
            $formSubmitted = true;
            redirect("login.php", "Successfully registerd, you may login now!");
        } else {
            redirect("login.php", "Something went wrong, please try again!");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
<div id="tsparticles"></div>
    <div class='main-container container mt-5'>
        <section class="text-center text-lg-start h-100 ">
            <div class="main-container container  py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="card-body p-5 shadow-5 text-center card-registration my-4">
                            <h2 class="fw-bold mb-5">Sign up now</h2>
                            <form class="" method="POST" id="reg-form" action="<?= htmlspecialchars($_SERVER['SCRIPT_NAME']) ?>" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 mb-4 text-start">
                                        <div class="form-outline">
                                            <input type="text" class="form-control" id="firstName" placeholder="First name" name="firstName" value="<?= $first_name ?>">

                                            <span class="text-danger"> <?= $fnameError ?> </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 text-start">
                                        <div class="form-outline">
                                            <input type="text" class="form-control" id="lastName" placeholder="Last name" name="lastName" value="<?= $last_name ?>">
                                            <span class=" text-danger"> <?= $lnameError ?> </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6 mb-4 text-start">
                                        <div class="form-outline">
                                            <input type="date" class="form-control" id="birthDate" placeholder="Birthday" name="birthDate" value="<?= $date_of_birth ?>">
                                            <span class=" text-danger"> <?= $dateError ?> </span>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <div class="form-outline mb-4 text-start">
                                            <div class="d-md-flex justify-content-start align-items-center py-2">
                                                <h6 class="mb-0 me-4">Gender: </h6>
                                                <div class="form-check form-check-inline mb-0 me-4">
                                                    <input class="form-check-input" type="radio" name="gender" id="femaleGender" value="female" <?= (isset($_POST['gender']) && $_POST['gender'] == 'female') ? 'checked' : '' ?> />
                                                    <label class="form-check-label" for="femaleGender">Female</label>
                                                </div>

                                                <div class="form-check form-check-inline mb-0 me-4">
                                                    <input class="form-check-input" type="radio" name="gender" id="maleGender" value="male" <?= (isset($_POST['gender']) && $_POST['gender'] == 'male') ? 'checked' : '' ?> />
                                                    <label class="form-check-label" for="maleGender">Male</label>
                                                </div>

                                            </div>
                                            <span class="text-danger my-0"><?= $genderError ?></span>
                                        </div>
                                    </div>
                                    <div>
                                    </div>
                                </div>
                                <!-- Profile Photo input -->
                                <div class="form-outline mb-4">
                                    <!-- <label class="form-label" for="picture">Upload Profile Photo</label> -->
                                    <input type="file" class="form-control" id="picture" name="picture" />

                                </div>
                                <!-- Email Input -->
                                <div class="row">
                                    <div class="col-12 mb-4 text-start">
                                        <div class="form-outline">
                                            <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="<?= $email ?>">
                                            <span class="text-danger"><?= $emailError ?></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Password input -->
                                <div class="row">
                                    <div class="col-12 mb-4 text-start">
                                        <div class="form-outline">
                                            <input type="password" class="form-control" id="password" placeholder="Create a new password" name="password">
                                            <span class="text-danger"> <?= $passError ?> </span>
                                            <!-- <label class="form-label" for="form3Example4">Password</label> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-4 text-start">
                                        <div class="form-outline">
                                            <input type="password" class="form-control" id="password1" placeholder="Confirm password" name="password1">
                                            <span class="text-danger"><?= $confirmPassError ?></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Address -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline text-start">
                                            <input type="text" class="form-control" id="state" placeholder="State" name="state" value="<?= $state ?>">
                                            <span class=" text-danger"> <?= $stateError ?> </span>

                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline  text-start">
                                            <input type="text" class="form-control" id="city" placeholder="City" name="city" value="<?= $city ?>">
                                            <span class=" text-danger"> <?= $cityError ?> </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline  text-start">
                                            <input type="text" class="form-control" id="street" placeholder="Street" name="street" value="<?= $street_address ?>">
                                            <span class=" text-danger"> <?= $streetError ?> </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline  text-start">
                                            <input type="text" class="form-control" id="zipCode" placeholder="Zip Code" name="zipCode" value="<?= $zip_code ?>">
                                            <span class=" text-danger"> <?= $zipError ?> </span>

                                        </div>
                                    </div>
                                </div>
                                <!-- Submit button -->
                                <button name="register" type="submit" id="button" type="submit" class="bn632-hover bn24 btn-block mb-4">
                                    Sign up
                                </button>
                                <input type="hidden" id="form-submitted" value="<?php echo $formSubmitted ? '1' : '0'; ?>">
                                <p class="text-center">Already have an account? <a href="login.php" class="fw-bold">Login here</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/tsparticles-all@2.12.0/tsparticles.all.bundle.min.js"></script>
    <script>
        tsParticles.load({
            id: "tsparticles",
            options: {
                "autoPlay": true,
                "background": {
                    "color": {
                        "value": "#ffffff"
                    },
                    "image": "url('https://particles.js.org/images/background3.jpg')",
                    "position": "50% 50%",
                    "repeat": "no-repeat",
                    "size": "cover",
                    "opacity": 1
                },
                "backgroundMask": {
                    "composite": "destination-out",
                    "cover": {
                        "color": {
                            "value": {
                                "r": 255,
                                "g": 255,
                                "b": 255
                            }
                        },
                        "opacity": 1
                    },
                    "enable": true
                },
                "defaultThemes": {},
                "delay": 0,
                "fullScreen": {
                    "enable": true,
                    "zIndex": 1
                },
                "detectRetina": true,
                "duration": 0,
                "fpsLimit": 120,
                "interactivity": {
                    "detectsOn": "window",
                    "events": {
                        "onClick": {
                            "enable": true,
                            "mode": "push"
                        },
                        "onDiv": {
                            "selectors": [],
                            "enable": false,
                            "mode": [],
                            "type": "circle"
                        },
                        "onHover": {
                            "enable": true,
                            "mode": "bubble",
                            "parallax": {
                                "enable": false,
                                "force": 60,
                                "smooth": 10
                            }
                        },
                        "resize": {
                            "delay": 0.5,
                            "enable": true
                        }
                    },
                    "modes": {
                        "trail": {
                            "delay": 1,
                            "pauseOnStop": false,
                            "quantity": 1
                        },
                        "attract": {
                            "distance": 200,
                            "duration": 0.4,
                            "easing": "ease-out-quad",
                            "factor": 1,
                            "maxSpeed": 50,
                            "speed": 1
                        },
                        "bounce": {
                            "distance": 200
                        },
                        "bubble": {
                            "distance": 400,
                            "duration": 2,
                            "mix": false,
                            "opacity": 1,
                            "size": 100,
                            "divs": {
                                "distance": 200,
                                "duration": 0.4,
                                "mix": false,
                                "selectors": []
                            }
                        },
                        "connect": {
                            "distance": 80,
                            "links": {
                                "opacity": 0.5
                            },
                            "radius": 60
                        },
                        "grab": {
                            "distance": 400,
                            "links": {
                                "blink": false,
                                "consent": false,
                                "opacity": 1
                            }
                        },
                        "push": {
                            "default": true,
                            "groups": [],
                            "quantity": 4
                        },
                        "remove": {
                            "quantity": 2
                        },
                        "repulse": {
                            "distance": 200,
                            "duration": 0.4,
                            "factor": 100,
                            "speed": 1,
                            "maxSpeed": 50,
                            "easing": "ease-out-quad",
                            "divs": {
                                "distance": 200,
                                "duration": 0.4,
                                "factor": 100,
                                "speed": 1,
                                "maxSpeed": 50,
                                "easing": "ease-out-quad",
                                "selectors": []
                            }
                        },
                        "slow": {
                            "factor": 3,
                            "radius": 200
                        },
                        "light": {
                            "area": {
                                "gradient": {
                                    "start": {
                                        "value": "#ffffff"
                                    },
                                    "stop": {
                                        "value": "#000000"
                                    }
                                },
                                "radius": 1000
                            },
                            "shadow": {
                                "color": {
                                    "value": "#000000"
                                },
                                "length": 2000
                            }
                        }
                    }
                },
                "manualParticles": [],
                "particles": {
                    "bounce": {
                        "horizontal": {
                            "random": {
                                "enable": false,
                                "minimumValue": 0.1
                            },
                            "value": 1
                        },
                        "vertical": {
                            "random": {
                                "enable": false,
                                "minimumValue": 0.1
                            },
                            "value": 1
                        }
                    },
                    "collisions": {
                        "absorb": {
                            "speed": 2
                        },
                        "bounce": {
                            "horizontal": {
                                "random": {
                                    "enable": false,
                                    "minimumValue": 0.1
                                },
                                "value": 1
                            },
                            "vertical": {
                                "random": {
                                    "enable": false,
                                    "minimumValue": 0.1
                                },
                                "value": 1
                            }
                        },
                        "enable": false,
                        "maxSpeed": 50,
                        "mode": "bounce",
                        "overlap": {
                            "enable": true,
                            "retries": 0
                        }
                    },
                    "color": {
                        "value": "#ffffff",
                        "animation": {
                            "h": {
                                "count": 0,
                                "enable": false,
                                "offset": 0,
                                "speed": 1,
                                "delay": 0,
                                "decay": 0,
                                "sync": true
                            },
                            "s": {
                                "count": 0,
                                "enable": false,
                                "offset": 0,
                                "speed": 1,
                                "delay": 0,
                                "decay": 0,
                                "sync": true
                            },
                            "l": {
                                "count": 0,
                                "enable": false,
                                "offset": 0,
                                "speed": 1,
                                "delay": 0,
                                "decay": 0,
                                "sync": true
                            }
                        }
                    },
                    "groups": {},
                    "move": {
                        "angle": {
                            "offset": 0,
                            "value": 90
                        },
                        "attract": {
                            "distance": 200,
                            "enable": false,
                            "rotate": {
                                "x": 600,
                                "y": 1200
                            }
                        },
                        "center": {
                            "x": 50,
                            "y": 50,
                            "mode": "percent",
                            "radius": 0
                        },
                        "decay": 0,
                        "distance": {},
                        "direction": "none",
                        "drift": 0,
                        "enable": true,
                        "gravity": {
                            "acceleration": 9.81,
                            "enable": false,
                            "inverse": false,
                            "maxSpeed": 50
                        },
                        "path": {
                            "clamp": true,
                            "delay": {
                                "random": {
                                    "enable": false,
                                    "minimumValue": 0
                                },
                                "value": 0
                            },
                            "enable": false,
                            "options": {}
                        },
                        "outModes": {
                            "default": "out",
                            "bottom": "out",
                            "left": "out",
                            "right": "out",
                            "top": "out"
                        },
                        "random": false,
                        "size": false,
                        "speed": 2,
                        "spin": {
                            "acceleration": 0,
                            "enable": false
                        },
                        "straight": false,
                        "trail": {
                            "enable": false,
                            "length": 10,
                            "fill": {}
                        },
                        "vibrate": false,
                        "warp": false
                    },
                    "number": {
                        "density": {
                            "enable": true,
                            "width": 1920,
                            "height": 1080
                        },
                        "limit": 0,
                        "value": 80
                    },
                    "opacity": {
                        "random": {
                            "enable": false,
                            "minimumValue": 0.1
                        },
                        "value": 1,
                        "animation": {
                            "count": 0,
                            "enable": false,
                            "speed": 1,
                            "decay": 0,
                            "delay": 0,
                            "sync": false,
                            "mode": "auto",
                            "startValue": "random",
                            "destroy": "none",
                            "minimumValue": 0.1
                        }
                    },
                    "reduceDuplicates": false,
                    "shadow": {
                        "blur": 0,
                        "color": {
                            "value": "#000"
                        },
                        "enable": false,
                        "offset": {
                            "x": 0,
                            "y": 0
                        }
                    },
                    "shape": {
                        "close": true,
                        "fill": true,
                        "options": {},
                        "type": "circle"
                    },
                    "size": {
                        "random": {
                            "enable": true,
                            "minimumValue": 1
                        },
                        "value": {
                            "min": 1,
                            "max": 30
                        },
                        "animation": {
                            "count": 0,
                            "enable": false,
                            "speed": 40,
                            "decay": 0,
                            "delay": 0,
                            "sync": false,
                            "mode": "auto",
                            "startValue": "random",
                            "destroy": "none",
                            "minimumValue": 0.1
                        }
                    },
                    "stroke": {
                        "width": 0
                    },
                    "zIndex": {
                        "random": {
                            "enable": false,
                            "minimumValue": 0
                        },
                        "value": 0,
                        "opacityRate": 1,
                        "sizeRate": 1,
                        "velocityRate": 1
                    },
                    "destroy": {
                        "bounds": {},
                        "mode": "none",
                        "split": {
                            "count": 1,
                            "factor": {
                                "random": {
                                    "enable": false,
                                    "minimumValue": 0
                                },
                                "value": 3
                            },
                            "rate": {
                                "random": {
                                    "enable": false,
                                    "minimumValue": 0
                                },
                                "value": {
                                    "min": 4,
                                    "max": 9
                                }
                            },
                            "sizeOffset": true
                        }
                    },
                    "roll": {
                        "darken": {
                            "enable": false,
                            "value": 0
                        },
                        "enable": false,
                        "enlighten": {
                            "enable": false,
                            "value": 0
                        },
                        "mode": "vertical",
                        "speed": 25
                    },
                    "tilt": {
                        "random": {
                            "enable": false,
                            "minimumValue": 0
                        },
                        "value": 0,
                        "animation": {
                            "enable": false,
                            "speed": 0,
                            "decay": 0,
                            "sync": false
                        },
                        "direction": "clockwise",
                        "enable": false
                    },
                    "twinkle": {
                        "lines": {
                            "enable": false,
                            "frequency": 0.05,
                            "opacity": 1
                        },
                        "particles": {
                            "enable": false,
                            "frequency": 0.05,
                            "opacity": 1
                        }
                    },
                    "wobble": {
                        "distance": 5,
                        "enable": false,
                        "speed": {
                            "angle": 50,
                            "move": 10
                        }
                    },
                    "life": {
                        "count": 0,
                        "delay": {
                            "random": {
                                "enable": false,
                                "minimumValue": 0
                            },
                            "value": 0,
                            "sync": false
                        },
                        "duration": {
                            "random": {
                                "enable": false,
                                "minimumValue": 0.0001
                            },
                            "value": 0,
                            "sync": false
                        }
                    },
                    "rotate": {
                        "random": {
                            "enable": false,
                            "minimumValue": 0
                        },
                        "value": 0,
                        "animation": {
                            "enable": false,
                            "speed": 0,
                            "decay": 0,
                            "sync": false
                        },
                        "direction": "clockwise",
                        "path": false
                    },
                    "orbit": {
                        "animation": {
                            "count": 0,
                            "enable": false,
                            "speed": 1,
                            "decay": 0,
                            "delay": 0,
                            "sync": false
                        },
                        "enable": false,
                        "opacity": 1,
                        "rotation": {
                            "random": {
                                "enable": false,
                                "minimumValue": 0
                            },
                            "value": 45
                        },
                        "width": 1
                    },
                    "links": {
                        "blink": false,
                        "color": {
                            "value": "#fff"
                        },
                        "consent": false,
                        "distance": 100,
                        "enable": false,
                        "frequency": 1,
                        "opacity": 1,
                        "shadow": {
                            "blur": 5,
                            "color": {
                                "value": "#000"
                            },
                            "enable": false
                        },
                        "triangles": {
                            "enable": false,
                            "frequency": 1
                        },
                        "width": 1,
                        "warp": false
                    },
                    "repulse": {
                        "random": {
                            "enable": false,
                            "minimumValue": 0
                        },
                        "value": 0,
                        "enabled": false,
                        "distance": 1,
                        "duration": 1,
                        "factor": 1,
                        "speed": 1
                    }
                },
                "pauseOnBlur": true,
                "pauseOnOutsideViewport": true,
                "responsive": [],
                "smooth": false,
                "style": {},
                "themes": [],
                "zLayers": 100,
                "motion": {
                    "disable": false,
                    "reduce": {
                        "factor": 4,
                        "value": true
                    }
                }
            }
        });
    </script>
</body>

</html>