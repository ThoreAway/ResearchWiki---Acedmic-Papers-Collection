import React from "react";

/**
 * A dropdown list for selecting papers based on if they have an award asociated with them or not 
 * 
 * The award selections are hard coded with base values, giving the options of viewing all papers, just papers that have 
 * been given an award or just papers that have not been awarded. The values can be used with papers component along with 
 * the paper API to display the selected papers.
 *
 * @author Jacob Clark w18003237
*/

class SelectAwarded extends React.Component {

    render() {
        return (
            <label>
                <select value={this.props.award} onChange={this.props.handleAwardSelect}>
                    <option value="">All</option>
                    <option value="all">Awarded</option>
                    <option value="none">Not Awarded</option>
                </select>
            </label>
                
        )
    }
}

export default SelectAwarded;