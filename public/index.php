<?php require_once('../private/initialize.php'); ?>


<?php include(SHARED_PATH . '/header.php'); ?>


<div class="hero-wrap js-fullheight" style="background-image: url('<?php echo url_for('/images/bg_2.jpg') ?>');" data-stellar-background-ratio="0.5">

	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">

			<div class="col-xl-10 ftco-animate mb-5 pb-5" data-scrollax=" properties: { translateY: '70%' }">

				<div class="ftco-search">
					<div class="row">
						<div class="col-md-12 nav-link-wrap">
							<div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
								<a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Find Service</a>
							</div>
						</div>
						<div class="col-md-12 tab-wrap">
							<div class="tab-content p-4" id="v-pills-tabContent">
								<div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
									<form action="<?php echo url_for('/search.php') ?>" method="get" class="search-job">
										<div class="row">
											<div class="col">
												<div class="form-group">
													<div class="form-field">
														<div class="icon"><span class="icon-briefcase"></span></div>
														<input type="text" name="query" class="form-control" placeholder="Click the Search button to view Service Providers" autocomplete="off">
													</div>
												</div>
											</div>
											<div class="col col-lg-2">
												<div class="form-group">
													<div class="form-field">
														<input type="Submit" name="search" value="Search" class="form-control btn btn-primary">
													</div>
												</div>
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
	</div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>