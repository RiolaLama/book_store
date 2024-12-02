<?php
session_start();

if (isset($_SESSION["user"])) {
    header("Location: index.php");
}
if (isset($_SESSION["admin"])) {
    header("Location: admin/dashboard.php");
}

require_once "config/db_connect.php";


$emailError = $email = $passError = "";
if (isset($_POST["btn-login"])) {
    $error = false;

    $email = cleanInput($_POST["email"]);
    $password = cleanInput($_POST["password"]);

    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email address.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email address!";
    }

    if (empty($password)) {
        $error = true;
        $passError = "Please enter your password!";
    }

    if (!$error) {
        $password = hash("sha256", $password);

        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($connect, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if ($count == 1) {
            if ($row["user_type"] == "admin") {
                $_SESSION["admin"] = $row["id"];
                header("Location: admin/dashboard.php");
            } else {
                $_SESSION["user"] = $row["id"];
                header("Location: index.php");
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- AlertifyJS Stylesheet -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div id="tsparticles"></div>
    <div class="main-container1 container mt-5 mt-lg-0">
        <div class="px-4 py-5 px-md-5 text-center text-lg-start mt-5 login-container">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h1 class="my-5 display-3 fw-bold ls-tight">
                            Discover a World of Knowledge at Our Library!</span>
                        </h1>
                        <p style="color: hsl(217, 10%, 50.8%)">
                            Welcome to our library, a treasure trove of knowledge and imagination. Step into a world where books hold the keys to countless adventures, profound insights, and boundless inspiration.
                        </p>
                    </div>
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <?php
                        if (isset($errMSG)) {
                            echo $errMSG;
                        } ?>
                        <div class="card">
                            <div class="card-body py-5 px-md-5">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="d-flex justify-content-center m-1">
                                        <h2>Log In</h2>
                                    </div>

                                    <!-- Email input -->
                                    <div class=" form-outline mb-4">
                                        <label class="form-label ps-2" for="form3Example4">Email</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" name="email" value="<?= $email ?>">
                                        <span class=" text-danger ps-2"> <?= $emailError ?> </span>
                                    </div>

                                    <!-- Password input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label ps-2" for="form3Example4">Password</label>
                                        <input type="password" class="form-control" id="exampleFormControlInput1" name="password">
                                        <span class="text-danger ps-2"> <?= $passError ?> </span>

                                    </div>

                                    <div class="text-center m-2 ">
                                        <button class="btn bn632-hover bn24 btn-block mb-3" type="submit" name="btn-login">Login</button>
                                        <div>
                                            <p class="mb-0">Don't have an account? <a href="register.php" class="fw-bold">Sign Up</a>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- Alertify JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <!-- Particles Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/tsparticles-all@2.12.0/tsparticles.all.bundle.min.js"></script>

    <script>
        // Particles
        tsParticles.load({
            id: "tsparticles",
            options: {
                "autoPlay": true,
                "background": {
                    "color": {
                        "value": "#fff"
                    },
                    "image": "",
                    "position": "50% 50%",
                    "repeat": "no-repeat",
                    "size": "cover",
                    "opacity": 1
                },
                "backgroundMask": {
                    "composite": "destination-out",
                    "cover": {
                        "color": {
                            "value": "#fff"
                        },
                        "opacity": 1
                    },
                    "enable": false
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
                            "mode": "emitter"
                        },
                        "onDiv": {
                            "selectors": [],
                            "enable": false,
                            "mode": [],
                            "type": "circle"
                        },
                        "onHover": {
                            "enable": false,
                            "mode": "repulse",
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
                            "opacity": 0.8,
                            "size": 40,
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
                        },
                        "emitters": {
                            "random": {
                                "count": 1,
                                "enable": false
                            },
                            "value": {
                                "autoPlay": true,
                                "fill": true,
                                "life": {
                                    "wait": false,
                                    "count": 10,
                                    "delay": 0.5,
                                    "duration": 3
                                },
                                "rate": {
                                    "quantity": 1,
                                    "delay": 0.1
                                },
                                "shape": "square",
                                "startCount": 0,
                                "particles": {
                                    "shape": {
                                        "type": "star",
                                        "polygon": {
                                            "sides": 7
                                        }
                                    },
                                    "rotate": {
                                        "value": 0,
                                        "random": true,
                                        "direction": "clockwise",
                                        "animation": {
                                            "enable": true,
                                            "speed": 15,
                                            "sync": false
                                        }
                                    },
                                    "color": {
                                        "value": "#f0f"
                                    },
                                    "lineLinked": {
                                        "enable": false
                                    },
                                    "opacity": {
                                        "value": 1
                                    },
                                    "size": {
                                        "value": 15,
                                        "random": false
                                    },
                                    "move": {
                                        "speed": 20,
                                        "random": false,
                                        "outMode": "destroy"
                                    }
                                }
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
                        "value": "#000",
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
                            "enable": false,
                            "width": 1920,
                            "height": 1080
                        },
                        "limit": 0,
                        "value": 100
                    },
                    "opacity": {
                        "random": {
                            "enable": false,
                            "minimumValue": 0.1
                        },
                        "value": 0.5,
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
                            "max": 5
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
                            "value": "#000"
                        },
                        "consent": false,
                        "distance": 150,
                        "enable": true,
                        "frequency": 1,
                        "opacity": 0.4,
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
                "emitters": [{
                    "autoPlay": true,
                    "fill": true,
                    "life": {
                        "wait": false
                    },
                    "rate": {
                        "quantity": 1,
                        "delay": 0.1
                    },
                    "shape": "square",
                    "startCount": 0,
                    "size": {
                        "mode": "percent",
                        "height": 0,
                        "width": 100
                    },
                    "direction": "top",
                    "particles": {
                        "color": {
                            "value": ["#5bc0eb", "#fde74c", "#9bc53d", "#e55934", "#fa7921"]
                        },
                        "lineLinked": {
                            "enable": false
                        },
                        "size": {
                            "value": 400,
                            "random": {
                                "enable": true,
                                "minimumValue": 200
                            }
                        },
                        "opacity": {
                            "value": 0.5
                        },
                        "move": {
                            "speed": 10,
                            "random": false,
                            "outMode": "destroy"
                        }
                    },
                    "position": {
                        "x": 50,
                        "y": 105
                    }
                }, {
                    "autoPlay": true,
                    "fill": true,
                    "life": {
                        "wait": false
                    },
                    "rate": {
                        "quantity": 1,
                        "delay": 0.1
                    },
                    "shape": "square",
                    "startCount": 0,
                    "direction": "top-right",
                    "particles": {
                        "shape": {
                            "type": "star"
                        },
                        "color": {
                            "value": "#f00"
                        },
                        "lineLinked": {
                            "enable": true
                        },
                        "opacity": {
                            "value": 0.3
                        },
                        "rotate": {
                            "value": 0,
                            "random": true,
                            "direction": "counter-clockwise",
                            "animation": {
                                "enable": true,
                                "speed": 15,
                                "sync": false
                            }
                        },
                        "size": {
                            "value": 10,
                            "random": {
                                "enable": true
                            }
                        },
                        "move": {
                            "speed": 10,
                            "random": false,
                            "outMode": "destroy"
                        }
                    },
                    "position": {
                        "x": 0,
                        "y": 100
                    }
                }, {
                    "autoPlay": true,
                    "fill": true,
                    "life": {
                        "wait": false
                    },
                    "rate": {
                        "quantity": 1,
                        "delay": 0.1
                    },
                    "shape": "square",
                    "startCount": 0,
                    "direction": "top-left",
                    "particles": {
                        "shape": {
                            "type": "square"
                        },
                        "rotate": {
                            "value": 0,
                            "random": true,
                            "direction": "clockwise",
                            "animation": {
                                "enable": true,
                                "speed": 15,
                                "sync": false
                            }
                        },
                        "color": {
                            "value": "#00f"
                        },
                        "lineLinked": {
                            "enable": false
                        },
                        "opacity": {
                            "value": 0.8
                        },
                        "size": {
                            "value": 15,
                            "random": false
                        },
                        "move": {
                            "speed": 20,
                            "random": false,
                            "outMode": "destroy"
                        }
                    },
                    "position": {
                        "x": 100,
                        "y": 100
                    }
                }, {
                    "autoPlay": true,
                    "fill": true,
                    "life": {
                        "wait": false,
                        "count": 10,
                        "delay": 0.5,
                        "duration": 3
                    },
                    "rate": {
                        "quantity": 1,
                        "delay": 0.1
                    },
                    "shape": "square",
                    "startCount": 0,
                    "particles": {
                        "shape": {
                            "type": "polygon",
                            "polygon": {
                                "sides": 6
                            }
                        },
                        "rotate": {
                            "value": 0,
                            "random": true,
                            "direction": "clockwise",
                            "animation": {
                                "enable": true,
                                "speed": 15,
                                "sync": false
                            }
                        },
                        "color": {
                            "value": "#0f0"
                        },
                        "lineLinked": {
                            "enable": false
                        },
                        "opacity": {
                            "value": 1
                        },
                        "size": {
                            "value": 15,
                            "random": false
                        },
                        "move": {
                            "speed": 20,
                            "random": false,
                            "outMode": "destroy"
                        }
                    }
                }],
                "motion": {
                    "disable": false,
                    "reduce": {
                        "factor": 4,
                        "value": true
                    }
                }
            }
        });
        // Display Alert Message
        <?php
        if (isset($_SESSION['message'])) {
            if (($_SESSION['type']) == 'danger') {
        ?>
                alertify.set('notifier', 'position', 'top-right');
                alertify.error('<?= $_SESSION['message'] ?>');
            <?php
            } else  if (($_SESSION['type']) == 'success') {
            ?>
                alertify.set('notifier', 'position', 'top-right');
                alertify.success('<?= $_SESSION['message'] ?>');
        <?php
            }
        }
        unset($_SESSION['message']);
        unset($_SESSION['type']);
        ?>
    </script>
</body>

</html>