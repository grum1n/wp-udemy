import Rating from "@mui/material/Rating/index.js";
import { render, useState } from "@wordpress/element";//ok
//import { apiFetch } from '@wordpress/api-fetch'; // video
import apiFetch from '@wordpress/api-fetch'; // handbook

function RecipeRating(props){
    const [avgRating, setAvgRating] = useState(props.avgRating) 
    const [permission, setPermission] = useState(props.loggedIn) 

    return (
        <Rating
            value={avgRating} 
            precision={0.5}
            onChange={async (event, rating) => {
                if(!permission){
                    return alert('You have already rated this recipe or you may need to log in.')
                }

                setPermission(false)

                const response = await apiFetch({
                    //example.com/wp-json/up/v1/rate
                    path: 'up/v1/rate',
                    method:'POST',
                    data: {
                        postID: props.postID,
                        rating
                    }
                })

                if(response.status == 2 ){
                    setAvgRating(response.rating)
                }
            }}
        />
    )
}

document.addEventListener('DOMContentLoaded', () => {
    const block = document.querySelector('#recipe-rating');
    const postID = parseInt(block.dataset.postId);
    const avgRating = parseFloat(block.dataset.avgRating);
    const loggedIn = !!block.dataset.loggedIn;

   render(
        <RecipeRating 
            postID={postID}
            avgRating={avgRating}
            loggedIn={loggedIn}
        />,
        block
   )
})