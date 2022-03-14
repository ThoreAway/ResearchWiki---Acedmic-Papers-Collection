import React from "react";
import Papers from "./Papers.js";
import stacks from "./../img/stack.jpg"

/**
 * HomePage used to build up the content displayed within home route
 *   
 * Features some filler text and a relevant research related image that is displayed. Also uses the papers component with the 
 * randomPaper prop set to true. This returns a random paper to be displayed using a function built into the componentDidMount of 
 * papers.
 * 
 * Content is spilt up into sectioned divs so it can be styled.
 * 
 * @author Jacob Clark w18003237
*/

class HomePage extends React.Component {

    render() {
        return (
            <div className="homeWrapper">

                <div className="main">
                    <h2>Welcome to ResearchWiki</h2>
                    <p>ResreachWiki is a nonprofit organisation that has a focus on cataloging and presenting information regarding research papers from around the world. We have an extensive list of both papers and authors that can be searched through. Also, dont forget to check out our reading list page where you can mark down papers your interested in to read through at a later date.</p>
                </div>

                <div className="tPaper">
                    <h3>Trending paper:</h3>
                    <Papers randomPaper={true} />
                    <p>Click the paper to see more details.</p>
                </div>

                <div className="tQuote">
                    <h3>Todays quote:</h3>
                    <p>“No thief, however skillful, can rob one of knowledge, and that is why knowledge is the best and safest treasure to acquire.”  ― L. Frank Baum, The Lost Princess of Oz</p>
                </div>

                <div className="photo">
                    <img src={stacks} className="stacks" alt="paper-stacks" />
                    <p>
                        Photo by <a href="https://unsplash.com/@seargreyson?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Sear Greyson</a> on <a href="https://unsplash.com/?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>
                    </p>
                </div>
            </div>
        )
    }
}

export default HomePage;