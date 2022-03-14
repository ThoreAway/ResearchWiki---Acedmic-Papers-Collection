import React from "react";
import Authors from "./Authors";

/**
 * Paper component to build up each individual paper and the data it will display
 * 
 * Features a handleclick method to display further details on the paper when the component is clicked. This works by changing the 
 * display status using an onClick with paper title div. 
 * 
 * The render method displays individual atributes of the paper defining them as a jsx prop using their name within paragraph tags. It 
 * also calls the authors components aand passes a paper id to display all the authors that worked on the defined paper.
 *
 * @author Jacob Clark w18003237
*/


class Paper extends React.Component {

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
        let nan =" ";

        if (!this.props.paper.award){
            nan = "No awards to be displayed"
        }

        if (this.state.display) {

            details = <div className="details">

                      <h4>Abstract:</h4>
                      <p>{this.props.paper.abstract}</p>

                      <h4>Awards:</h4>
                      <p> {nan} {this.props.paper.award}</p>

                      <h4>Credited authors:</h4>
                      <Authors paperid={this.props.paper.PaperId} />
                      </div>
        }
        return(
            <div onClick={this.handleClick}>
                <p>{this.props.paper.title}</p>
                {details}
            </div>
        )
    }
}

export default Paper;