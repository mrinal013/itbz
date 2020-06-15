<?php
namespace wp_public;

trait WP_Admin_Vue_Video {
    public function add_video_forum_endpoint() {
		$special_slug = str_replace( ' ', '-', get_option( 'itbz-slug' ) );
		add_rewrite_endpoint( $special_slug, EP_ROOT | EP_PAGES );
	}

	public function video_forum_query_vars( $vars ) {
		$special_slug = str_replace( ' ', '-', get_option( 'itbz-slug' ) );
		$vars[] = $special_slug;
		return $vars;
	}

	public function add_video_forum_link_my_account( $items ) {
		$special_slug = str_replace( ' ', '-', get_option( 'itbz-slug' ) );
		$items[$special_slug] = strtoupper( get_option( 'itbz-slug' ) );
		return $items;
	}

	public function video_forum_content() {
		$my_videos = [];
		$others = [];
		if( ! empty( $this->videos ) ) {
			foreach( $this->videos as $video ) {
				if( $video->customer == $this->customer_id ) {
					$my_videos[] = $video;
				} else {
					$others[] = $video;
				}
			}
		}
		?>
		<div class="row">
			<div class="col-12">
				<div id="upload">
					<input type="file" accept="video/mp4" @change="onFileSelected">
					<p>( Upload mp4 file within 20MB to 200MB )</p>
					<p class="text-danger">{{ uploadInvalid }}</p>
					<button class="btn btn-primary" @click="onUpload" :disabled="!!uploadDisable">Upload</button>
					<div>
						<p>Progress: {{uploadValue.toFixed()+"%"}}
						<progress id="progress" :value="uploadValue" max="100" ></progress>  </p>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="container">
			<h2>My videos</h2>
			<div class="row">
			<?php
			if( ! empty( $my_videos) ) :
				$my_videos_order = array_reverse( $my_videos );
				foreach( $my_videos_order as $my_video ) :
					if( ! empty( $my_video->url ) ) :
			?>
				<div class="col-6">
					<video width="320" height="240" controls>
						<source src="<?php echo $my_video->url; ?>" type="video/mp4">
						Your browser does not support the video tag.
					</video>
				</div>
			<?php
					endif;
				endforeach;
			endif;
			?>
			</div>
			<h2>Others videos</h2>
			<div class="row">
				<?php
				if( ! empty( $others) ) :
					foreach( $others as $other ) :
				?>
				<div class="col-6">
					<video width="320" height="240" controls controlsList="nodownload">
						<source src="<?php echo $other->url; ?>" type="video/mp4">
						Your browser does not support the video tag.
					</video>
				</div>
				<?php
				endforeach;
			endif;
			?>
			</div>
		</div>
		<?php
	}
}