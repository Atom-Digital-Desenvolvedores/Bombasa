<?php
/* WIDGETS */

	function arphabet_widgets_init() {
		register_sidebar( array(
			'name'          => 'Sidebar do blog',
			'id'            => 'sidebar_blog',
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="rounded">',
			'after_title'   => '</h2>',
		));
	}
	add_action( 'widgets_init', 'arphabet_widgets_init' );

	Class WQ_Widget_Search extends WP_Widget_Search {
		function widget( $args, $instance ) {
			$title = ! empty( $instance['title'] ) ? $instance['title'] : "";
			?>
				<div class="wq-buscar">
					<?php
						if ($title !== NULL && strlen($title) > 0) {
							?>
								<h3><?php echo $title; ?></h3>
							<?php
						}
					?>
					<form method="get" action="<?php echo home_url(); ?>">
						<input type="text" placeholder="Buscar" name="s">
						<button type="submit" class="flaticon-search-1"></button>
					</form>
				</div>
			<?php
		}
	}



	/**/
	Class WQ_Widget_Recent_Posts extends WP_Widget_Recent_Posts {
		public function widget( $args, $instance ) {
			if ( ! isset( $args['widget_id'] ) ) {
				$args['widget_id'] = $this->id;
			}

			$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );

			/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
			$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

			$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
			if ( ! $number )
				$number = 5;
			$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

			/**
			 * Filters the arguments for the Recent Posts widget.
			 *
			 * @since 3.4.0
			 *
			 * @see WP_Query::get_posts()
			 *
			 * @param array $args An array of arguments used to retrieve the recent posts.
			 */
			$r = new WP_Query( apply_filters( 'widget_posts_args', array(
				'posts_per_page'      => $number,
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true
			) ) );

			if ($r->have_posts()) :
			?>

		<div class="wq-posts_recentes">
			<?php echo $args['before_widget']; ?>
			<h3>
			<?php if ( $title ) {
				echo $title;
			} ?>
			</h3>
			<?php $itens = 0; while ( $r->have_posts() ) : $r->the_post();
					$attachID = get_post_thumbnail_id(get_the_ID());
					$author_id = get_post_field ('post_author', get_the_ID());
					$display_name = get_the_author_meta( 'first_name' , $author_id );
					if ($itens == $number) {
						break;
					}
					$itens++;
					$categories = get_the_terms( get_the_ID(), 'category' );
					$htmlCategory = '';
					if ( $categories && ! is_wp_error( $categories ) ){
						$draught_links = array();
						foreach ($categories as $category) {
							$item = '<a href="'.get_term_link($category->term_id, "category").'" title="'.$category->name.'" > '.$category->name.'</a>';
							array_push($draught_links, $item);
						}
						$htmlCategory = implode(' | ', $draught_links);
					}
				?>

					<div class="wq-posts_recentes-box">
						<figure>
							<a href="<?php the_permalink(); ?>">
								<?php getImageThumb($attachID, '300x240'); ?>
							</a>
						</figure>
						<div>
							<ul class="wq-blog_info wq-lista-inline">
								<li>
									<img src="<?php bloginfo('template_url') ?>/img/blog_icone-1.png" alt="icone de Data" title="Data">
									<span><?php echo get_the_date('d', $item->ID); ?>.<?php echo get_the_date('m', $item->ID); ?>.<?php echo get_the_date('Y', $item->ID); ?></span>
								</li>
								<li>
									<img src="<?php bloginfo('template_url') ?>/img/blog_icone-2.png" alt="icone de Categoria" title="Categoria">
									<?php echo $htmlCategory; ?>
								</li>
							</ul>
							<h2><a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></h2>
							<p><?php the_excerpt(); ?></p>
						</div>
					</div>

			<?php endwhile; ?>
			<?php echo $args['after_widget']; ?>
		</div>


			<?php
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

			endif;
		}


	/*
	    function widget( $args, $instance ) {
		?>
				<div class="wq-leia">
					<h4>Leia Também</h4>
					<?php
						$args = array (
							'post_type'         => 'post',
							'posts_per_page'    => 4
						);
						$query = new WP_Query( $args );
						$posts = $query->get_posts();
						foreach ($posts as $key => $post) {
							$attachID = get_post_thumbnail_id( $post->ID );
							$author_id=$post->post_author;
							?>
								<div class="wq-conteudo">
									<figure>
										<?php getImageThumb($attachID, 'img-blog-list-sidebar'); ?>
									</figure>
									<div class="wq-texto">
										<p class="data"><?php echo get_the_date('d.m.Y', $post->ID); ?> | Por: <span class="autor"><?php echo get_the_author_meta('first_name', $author_id); ?></span></p>
										<h2><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h2>
									</div>
								</div>
							<?php
						}
					?>
				</div>
		<?php
	    }

		/**
		 * Outputs the settings form for the Recent Posts widget.
		 *
		 * @since 2.8.0
		 * @access public
		 *
		 * @param array $instance Current settings.
		 */
		public function form( $instance ) {
			$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
			$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
			$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
	?>
			<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

			<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
	<?php
		}
	}
	/**/

	Class WQ_Widget_Tag_Cloud extends WP_Widget_Tag_Cloud {
	    function widget( $args, $instance ) {
			$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Categories' );

			/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
			$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		?>
			<div class="wq-tags">
				<h3><?php echo $title; ?></h3>
				<ul class="wq-lista-inline">
				<?php
					$tags = get_terms('post_tag', array(
						'hide_empty' => true,
					));
					foreach ($tags as $key => $tag) {
						?>
							<li><a href="<?php echo get_term_link( $tag->term_id, 'post_tag' ); ?>"><?php echo $tag->name; ?></a></li>
						<?php
					}
				?>
				</ul>
			</div>

		<?php
	    }
	}


	Class WQ_Categories_Widget extends WP_Widget_Categories {
		function widget( $args, $instance ) {

			static $first_dropdown = true;

			$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Categories' );

			/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
			$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

			$c = ! empty( $instance['count'] ) ? '1' : '0';
			$h = ! empty( $instance['hierarchical'] ) ? '1' : '0';
			$d = ! empty( $instance['dropdown'] ) ? '1' : '0';

			echo $args['before_widget'];
			$cat_args = array(
				'orderby'      => 'name',
				'show_count'   => $c,
				'hierarchical' => $h,
			);
			?>

				<div class="wq-categorias">
					<?php
						if ( $title ) {
							?>
								<h3><?php echo $title; ?></h3>
							<?php
						}
					?>
					<ul>
						<?php
							$cat_args['title_li'] = '';
							wp_list_categories( apply_filters( 'widget_categories_args', $cat_args, $instance ) );
						?>
					</ul>
				</div>
			<?php
			echo $args['after_widget'];
		}
		/**
		 * Outputs the settings form for the Categories widget.
		 *
		 * @since 2.8.0
		 * @access public
		 *
		 * @param array $instance Current settings.
		 */
		public function form( $instance ) {
			//Defaults
			$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
			$title = sanitize_text_field( $instance['title'] );
			$count = isset($instance['count']) ? (bool) $instance['count'] :false;
			$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
			$dropdown = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;
			?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hierarchical'); ?>" name="<?php echo $this->get_field_name('hierarchical'); ?>"<?php checked( $hierarchical ); ?> />
			<label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e( 'Show hierarchy' ); ?></label></p>

			<?php
		}
	}
	/*
	Class WQ_Categories_Widget extends WP_Widget_Categories {
	    function widget( $args, $instance ) {
		?>
		<div class="wsg-listagem">
			<h3>Categorias</h3>
			<ul>
				<?php
					$tags = get_terms('category', array(
						'hide_empty' => true,
					));
					foreach ($tags as $key => $tag) {
						?>
							<li><a href="<?php echo get_term_link( $tag->term_id, 'category' ); ?>"><?php echo $tag->name; ?></a></li>
						<?php
					}
				?>
			</ul>
		</div>

		<?php
	    }
	}
	*/

	function my_categories_widget_register() {
		unregister_widget( 'WP_Widget_Search' );
		register_widget( 'WQ_Widget_Search' );

		unregister_widget( 'WP_Widget_Categories' );
		register_widget( 'WQ_Categories_Widget' );

		unregister_widget( 'WP_Widget_Recent_Posts' );
		register_widget( 'WQ_Widget_Recent_Posts' );

		unregister_widget( 'WP_Widget_Tag_Cloud' );
		register_widget( 'WQ_Widget_Tag_Cloud' );

		//register_widget( 'WQ_Widget_NewSletter' );
	}
	add_action( 'widgets_init', 'my_categories_widget_register' );

	function remove_calendar_widget() {
		unregister_widget('WP_Widget_Pages');
		unregister_widget('WP_Widget_Calendar');
		unregister_widget('WP_Widget_Archives');
		unregister_widget('WP_Widget_Links');
		unregister_widget('WP_Widget_Meta');
		// unregister_widget('WP_Widget_Search');
		unregister_widget('WP_Widget_Text');
		// unregister_widget('WP_Widget_Custom_HTML');
		// unregister_widget('WP_Widget_Categories');
		unregister_widget('WP_Widget_Recent_Posts');
		unregister_widget('WP_Widget_Recent_Comments');
		unregister_widget('WP_Widget_RSS');
		// unregister_widget('WP_Widget_Tag_Cloud');
		unregister_widget('WP_Nav_Menu_Widget');
		unregister_widget('Twenty_Eleven_Ephemera_Widget');

		unregister_widget('WP_Widget_Media_Image');
		unregister_widget('WP_Widget_Media_Video');
		unregister_widget('WP_Widget_Media_Audio');
		// unregister_widget('WP_Widget_Pages');
		// unregister_widget('WP_Widget_Calendar');
		// unregister_widget('WP_Widget_Archives');
		// unregister_widget('WP_Widget_Links');
		// unregister_widget('WP_Widget_Meta');
		// // unregister_widget('WP_Widget_Search');
		// unregister_widget('WP_Widget_Text');
		// // unregister_widget('WP_Widget_Categories');
		// unregister_widget('WP_Widget_Recent_Posts');
		// unregister_widget('WP_Widget_Recent_Comments');
		// unregister_widget('WP_Widget_RSS');
		// unregister_widget('WP_Widget_Tag_Cloud');
		// unregister_widget('WP_Nav_Menu_Widget');
	}
	add_action( 'widgets_init', 'remove_calendar_widget' );

?>