

<div class="app-main__outer">
    <div id="refreshData">
        <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon">
                            <i class="fas fa-home"></i>
                            </div>
                            <div> Dashboard
                                <div class="page-title-subheading">
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
            <div class="row">
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card mb-3 widget-content bg-arielle-smile">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Total Exam</div>
                                    <div class="widget-subheading" style="color:transparent;">.</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white">
                                        <span><?php echo $totalCourse = $selExam['totExam']; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card mb-3 widget-content bg-dark">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Total Courses</div>
                                    <div class="widget-subheading" style="color:transparent;">.</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white">
                                        <span><?= $selCourse['totCourse']; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card mb-3 widget-content bg-warning">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Examinees</div>
                                    <div class="widget-subheading" style="color:transparent;">.</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white">
                                        <span><?= $examineeCount; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </div>
                </div>
            </div>
        </div>

        <!-- <?php include("includes/graph.php"); ?> -->
