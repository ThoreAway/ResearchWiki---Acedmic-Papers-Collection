import React from "react";
import Papers from "./Papers.js";
import SelectAwarded from "./SelectAwarded.js";
import SearchBox from "./SearchBox.js";

/**
 * PaperPage used to build up the content displayed within papers route
 *   
 * Uses the papers component along with searchbox and select awarded to display a list of papers that can be filtered through using  
 * the defined filter methods. State values are set within the consturctor before binding the various defined methods. The search and
 * awardselection methods are declared to accept the value being passed through by their respective components. The next and previous 
 * click buttons are also declared to change page state from the papers component. The render method then displays all the paperpage 
 * data using the Papers component along with the selectAwarded and SearchBox with it being split into class divs to be styled.
 * 
 * @author Jacob Clark w18003237
*/

class PaperPage extends React.Component {


    constructor(props) {
        super(props)
        this.state = {
            award: "",
            search: "",
            page: 1
        }

        this.handleAwardSelect = this.handleAwardSelect.bind(this);
        this.handleSearch = this.handleSearch.bind(this);
        this.handleNextClick = this.handleNextClick.bind(this);
        this.handlePreviousClick = this.handlePreviousClick.bind(this);
    }


    handleSearch = (e) => {
        this.setState({ search: e.target.value })
    }


    handleAwardSelect = (e) => {
        this.setState({ award: e.target.value })
    }

    handleNextClick = () => {
        this.setState({ page: this.state.page + 1 })
    }

    handlePreviousClick = () => {
        this.setState({ page: this.state.page - 1 })
    }

    render() {
        return (
            <div className="paperWrapper">
                <div className="header">
                    <h2>Paper Collection</h2>
                    <p>Select a paper to view its abstract, authors and the awards acredited to it</p>
                </div>

                <div className="filters">
                    <h2>Filter Results</h2>
                    <p>Search by title or abstract:</p>
                    <SearchBox search={this.state.search} handleSearch={this.handleSearch} />
                    <p>Select by awarded:</p>
                    <SelectAwarded a={this.state.award} handleAwardSelect={this.handleAwardSelect} />
                </div>
                <div className="papers">
                    <Papers
                        award={this.state.award}
                        search={this.state.search}
                        page={this.state.page}
                        handleNextClick={this.handleNextClick}
                        handlePreviousClick={this.handlePreviousClick} />
                </div>
            </div>
        )
    }
}

export default PaperPage;