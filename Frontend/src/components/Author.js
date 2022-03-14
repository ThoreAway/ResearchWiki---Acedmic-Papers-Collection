import React from "react";
import Papers from "./Papers.js";

/**
 * Author component to build up each individual author and the data it will display
 * 
 * Features a handleclick method to display a list of papers the author has worked on when the component is clicked. This works by 
 * changing the display status using an onClick within author names div. 
 * 
 * The render method displays individual atributes of the author defining them as a jsx prop using their name within paragraph tags. 
 * It also calls the papers components aand passes an author id to display all the papers ascociated the defined author.
 *
 * @author Jacob Clark w18003237
*/

class Author extends React.Component {

    constructor(props) {
        super(props)
        this.state = {
            display: false
        }
    }

    handleClick = () => {
        this.setState({display:!this.state.display})
    }

    render() {
        let details = "";

        if (this.state.display) {

            details = <div>
                    <Papers authorid={this.props.author.AuthorId}/>
                      </div>
        }
        return(
            <div>
            <div onClick={this.handleClick}>
                <p>{this.props.author.FirstName} {this.props.author.MiddleName} {this.props.author.LastName}</p>
            </div>
            {details}
            </div>
        )
    }
}

export default Author;