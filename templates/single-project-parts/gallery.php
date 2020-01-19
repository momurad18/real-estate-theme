<?php $images = get_field('gallery'); 
if($images):
?>
<rs-fullwidth-wrap  id="gallery_single_wrapper">
        <rs-module id="rev_gallery_single"
         class="ut-popup-group__element rev_slider utechs-rev_slider"  data-version="6.1.1">
            <rs-slides class="mh-popup-group">
                <?php foreach ( $images as $myhome_key => $myhome_image ) : ?>
                    <rs-slide data-index="rs-<?php echo esc_attr( $myhome_key ); ?>"
                    data-transition="slideleft"
                    data-slotamount="default"
                    data-hideafterloop="0"
                    data-hideslideonmobile="off"
                    data-easein="default"
                    data-easeout="default"
                    data-masterspeed="500"
                    data-thumb="<?php echo esc_url( wp_get_attachment_image_url( $myhome_image['ID'], 'full' ) ); ?>"
                    data-rotate="0"
                    data-fsslotamount="7"
                    data-saveperformance="off"
                    <?php if ( ! $myhome_key ) : ?>
                        data-fstransition="fade"
                        data-fsmasterspeed="300"
                    <?php endif; ?>
                    >
                        <img
                            src="<?php echo esc_url( wp_get_attachment_image_url( $myhome_image['ID'], 'full' ) ); ?>"
                        <?php if ( isset( $myhome_image['alt'] ) && ! empty( $myhome_image['alt'] ) ) : ?>
                            alt="<?php echo esc_attr( $myhome_image['alt'] ); ?>"
                        <?php else : ?>
                            alt="<?php the_title_attribute(); ?>"
                        <?php endif; ?>
                            class="rev-slidebg"
                            data-no-retina
                        >
                        <a
                            id="slider-20-slide-26-layer-0" 
                            class="rs-layer"
                            href="<?php echo esc_url( $myhome_image['url'] ); ?>"
                            data-type="shape"
                            data-rsp_ch="on"
                            data-xy="x:c;y:c;"
                            data-text="w:normal;"
                            data-dim="w:100%;h:100%;"
                            data-frame_999="o:0;st:w;"
                            style="z-index:5;background-color:rgba(0,0,0,0);"
                            > 
                        </a>
                    

                    </rs-slide>
                <?php endforeach; ?>
            </rs-slides>
        </rs-module>
</rs-fullwidth-wrap>

<?php endif ?>