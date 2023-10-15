<?php

$education_insight_custom_style= "";

$educate_training_coach_slider_content_alignment = get_theme_mod( 'educate_training_coach_slider_content_alignment','LEFT-ALIGN');

if($educate_training_coach_slider_content_alignment == 'LEFT-ALIGN'){

$education_insight_custom_style .='.carousel-caption{';

	$education_insight_custom_style .='text-align:left; right: 50%; left: 15%;';

$education_insight_custom_style .='}';

}else if($educate_training_coach_slider_content_alignment == 'CENTER-ALIGN'){

$education_insight_custom_style .='.carousel-caption{';

$education_insight_custom_style .='text-align:center; right: 30%; left: 30%;';

$education_insight_custom_style .='}';


}else if($educate_training_coach_slider_content_alignment == 'RIGHT-ALIGN'){

$education_insight_custom_style .='.carousel-caption{';

$education_insight_custom_style .='text-align:right;  right: 15%; left: 50%;';

$education_insight_custom_style .='}';

} 




	