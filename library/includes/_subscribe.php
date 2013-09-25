	<div class="subscribe row-grey clearfix">
		<form id="" class="clearfix" action="">
				<h2>Subscribe to related content</h2>
				<p>Get notified when more content like this is available.</p>
				<ul class="no-bullets">
					<li>
						<label class="off-left" for="subscriber">Your email</label>
						<span><input class="text" type="email" name="author" autocorrect="on" autocapitalize="on" id="subscriber" value="<?php echo $comment_author; ?>" size="22" tabindex="6" <?php if ($req) echo "aria-required='true'"; ?> /></span>
					</li>
					<li>
						<button name="submit" type="submit" id="submit" tabindex="10">Subscribe</button>
					</li>
				</ul>
		</form>
	</div><!-- /.subscribe -->
