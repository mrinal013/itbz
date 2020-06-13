<?php
namespace wp_public;

trait WP_Admin_Vue_Video {
    public function add_video_forum_endpoint() {
		add_rewrite_endpoint( 'video-forum', EP_ROOT | EP_PAGES );
	}

	public function video_forum_query_vars( $vars ) {
		$vars[] = 'video-forum';
		return $vars;
	}

	public function add_video_forum_link_my_account( $items ) {
		$items['video-forum'] = 'Video Forum';
		return $items;
	}

	public function video_forum_content() {
		?>
		<div class="row">
			<div class="col-12">
				Video Upload section 
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
	
	Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="container">
			<h2>My videos</h2>
			<div class="row">
				<div class="col-6">
					<div class="card">
						<img class="card-img-top" src="https://dummyimage.com/600x400/000/fff" alt="Card image cap">
						<div class="card-body">
							<a href="#" class="btn btn-primary">Download</a>
						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="card">
						<img class="card-img-top" src="https://dummyimage.com/600x400/000/fff" alt="Card image cap">
						<div class="card-body">
							<a href="#" class="btn btn-primary">Download</a>
						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="card">
						<img class="card-img-top" src="https://dummyimage.com/600x400/000/fff" alt="Card image cap">
						<div class="card-body">
							<a href="#" class="btn btn-primary">Download</a>
						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="card">
						<img class="card-img-top" src="https://dummyimage.com/600x400/000/fff" alt="Card image cap">
						<div class="card-body">
							<a href="#" class="btn btn-primary">Download</a>
						</div>
					</div>
				</div>
			</div>
			<h2>Others video</h2>
			<div class="row">
				<div class="col-6">
					<div class="card">
						<img class="card-img-top" src="https://dummyimage.com/600x400/000/fff" alt="Card image cap">
						<div class="card-body">
						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="card">
						<img class="card-img-top" src="https://dummyimage.com/600x400/000/fff" alt="Card image cap">
						<div class="card-body">
						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="card">
						<img class="card-img-top" src="https://dummyimage.com/600x400/000/fff" alt="Card image cap">
						<div class="card-body">
						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="card">
						<img class="card-img-top" src="https://dummyimage.com/600x400/000/fff" alt="Card image cap">
						<div class="card-body">
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}