  
<div class="container-fluid" id="footer">
    <div class="container">
    <!-- <div class="row">
        <div class="col-md-4">
            <h4>Contact Us</h4>
<p>We are the <a href="https://www.citl.mun.ca" target="_blank" rel="noopener">Centre for Innovation in Teaching &amp; Learning (CITL)</a>. </p>
<p>Contact us for a&nbsp;<a href="https://citl.mun.ca/TeachingSupport/consultation/" target="_blank" rel="noopener">consultation</a>.</p>

<ul class="social-links">
    <li>
        <a target="_blank" href="https://twitter.com/CITL_MemorialU" class="social-icon twitter">
            Twitter</a></li>
    <li><a target="_blank" href="https://www.youtube.com/channel/UCnkUgpDPNICHXrLQnLJNubA/" class="social-icon youtube">
        YouTube</a></li>
    <li><a target="_blank" href="https://www.facebook.com/CITL.MemorialU/.png" class="social-icon facebook">
        Facebook</a></li>
            <li><a target="_blank" href="https://www.linkedin.com/showcase/centre-for-innovation-in-teaching-and-learning-citl/" class="social-icon linkedin">
        LinkedIn</a></li>

</ul>
</div>

        <div class="col-md-6">
            
            <h4>Additional Resources</h4>
<p>View our professional development <a href="https://blog.citl.mun.ca/technologyresources/workshop-cons/" target="_blank" rel="noopener">events calendar</a>.</p>
<p>Visit the <a title="Visit the Technology Resources site for technical information about how to use education tools, including those in Brightspace." href="https://blog.citl.mun.ca/technologyresources/" target="_blank" rel="noopener">Technology Resources</a> site for technical information about how to use education tools, including those in Brightspace.</p>




        </div>

    </div>
-->

<?php 
    $footer_text = get_option('footer_custom_text');
    if ( !empty($footer_text) ) {
        echo '<div class="custom-footer-content">' . wp_kses_post($footer_text) . '</div>';
    }
?>
    </div>
</div>
  <?php wp_footer(); ?>
</body>
</html>
