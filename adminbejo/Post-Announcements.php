<?php
    include '../include/staff_restrict_pages.php';
    include 'headerAdmin.php';
    include '../db/DBconn.php';
?>
<link rel="stylesheet" href="css/Post-Announcements.css">
<div class="container fluid d-flex justify-content-center">
    <section class="main">
        <a href="Create-Post.php">
            <button class="btn btn-primary">Create Post</i></button>
        </a>
        <div class="row">
            <div class="col-6">
                <div class="Posts">
                    <div class="">
                        <a href="#" class="trending-button">Trending</a>
                        <a href="#" class="latest-button">Latest</a>
                    </div>
                    <div class="Post">
                        <h3>Title</h3>
                        <p>Content</p>
                        <p>Posted # Hrs Ago</p>
                        <div id="PostCarousel" class="carousel slide d-flex" data-bs-interval="false">
                            <div class="carousel-inner">
                                <div class="carousel-item active h-100">
                                    <video class="video" controls autoplay loop>
                                        <source src="../db/PostMedias/Videos/TestVideo.mp4" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#PostCarousel" data-bs-slide="prev">
                                <i class="prev fa-solid fa-chevron-left" aria-hidden="true"></i>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#PostCarousel" data-bs-slide="next">
                                <i class="next fa-solid fa-chevron-right" aria-hidden="true"></i>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <button class="btn btn-primary"><i class="fa-solid fa-thumbs-up"></i></button>
                        <span class="">999</span>
                        <button class="btn btn-primary"><i class="fa-solid fa-thumbs-down"></i></button>
                        <span class="">999</span>
                    </div>
                    <div class="Post">
                        <h3>Title</h3>
                        <p>Content</p>
                        <p>Posted # Hrs Ago</p>
                        <div id="Post2" class="carousel slide d-flex" data-bs-interval="false">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#Post2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#Post2" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#Post2" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="../db/PostMedias/Images/Image1.jpg" class="image" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="../db/PostMedias/Images/Image2.jpg" class="image" alt="...">
                                </div>
                                <div class="carousel-item h-100">
                                    <video class="video" controls autoplay muted loop>
                                        <source src="../db/PostMedias/Videos/TestVideo.mp4" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#Post2" data-bs-slide="prev">
                                <i class="prev fa-solid fa-chevron-left" aria-hidden="true"></i>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#Post2" data-bs-slide="next">
                                <i class="next fa-solid fa-chevron-right" aria-hidden="true"></i>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <button class="btn btn-primary"><i class="fa-solid fa-thumbs-up"></i></button>
                        <span class="">999</span>
                        <button class="btn btn-primary"><i class="fa-solid fa-thumbs-down"></i></button>
                        <span class="">999</span>
                    </div>
                    <div class="Post">
                        <h3>Title</h3>
                        <p>Content</p>
                        <p>Posted # Hrs Ago</p>
                        <div id="Post3" class="carousel slide d-flex" data-bs-interval="false">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#Post3" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#Post3" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#Post3" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="../db/PostMedias/Images/Image1.jpg" class="image" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="../db/PostMedias/Images/Image2.jpg" class="image" alt="...">
                                </div>
                                <div class="carousel-item h-100">
                                    <video class="video" controls autoplay muted loop>
                                        <source src="../db/PostMedias/Videos/TestVideo.mp4" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#Post3" data-bs-slide="prev">
                                <i class="prev fa-solid fa-chevron-left" aria-hidden="true"></i>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#Post3" data-bs-slide="next">
                                <i class="next fa-solid fa-chevron-right" aria-hidden="true"></i>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <button class="btn btn-primary"><i class="fa-solid fa-thumbs-up"></i></button>
                        <span class="">999</span>
                        <button class="btn btn-primary"><i class="fa-solid fa-thumbs-down"></i></button>
                        <span class="">999</span>
                    </div>
                    <p class="pagination text-center">Pagination Here</p>
                </div>
            </div>
            <div class="col-6">
                <div class="Pinned-Posts">
                    <h2>Pinned Posts</h2>
                    <div class="Pinned-Post">
                        <h5>Title</h5>
                        <button class="btn btn-primary"><i class="fa-solid fa-thumbs-up"></i></button>
                        <span class="">999</span>
                        <button class="btn btn-primary"><i class="fa-solid fa-thumbs-down"></i></button>
                        <span class="">999</span>
                    </div>
                    <div class="Pinned-Post">
                        <h5>Title</h5>
                        <button class="btn btn-primary"><i class="fa-solid fa-thumbs-up"></i></button>
                        <span class="">999</span>
                        <button class="btn btn-primary"><i class="fa-solid fa-thumbs-down"></i></button>
                        <span class="">999</span>
                    </div>
                    <div class="Pinned-Post">
                        <h5>Title</h5>
                        <button class="btn btn-primary"><i class="fa-solid fa-thumbs-up"></i></button>
                        <span class="">999</span>
                        <button class="btn btn-primary"><i class="fa-solid fa-thumbs-down"></i></button>
                        <span class="">999</span>
                    </div>
                    <div class="Pinned-Post">
                        <h5>Title</h5>
                        <button class="btn btn-primary"><i class="fa-solid fa-thumbs-up"></i></button>
                        <span class="">999</span>
                        <button class="btn btn-primary"><i class="fa-solid fa-thumbs-down"></i></button>
                        <span class="">999</span>
                    </div>
                    <div class="Pinned-Post">
                        <h5>Title</h5>
                        <button class="btn btn-primary"><i class="fa-solid fa-thumbs-up"></i></button>
                        <span class="">999</span>
                        <button class="btn btn-primary"><i class="fa-solid fa-thumbs-down"></i></button>
                        <span class="">999</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="#"></script>
<?php include 'footerAdmin.php'; ?>