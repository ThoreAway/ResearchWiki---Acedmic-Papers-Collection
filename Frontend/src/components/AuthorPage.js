import React from "react";
import SearchBox from "./SearchBox.js";
import Authors from "./Authors.js";


/**
 * AuthorPage used to build up the content displayed within authors route
 *   
 * Uses the Authors component along with searchbox to display a list of authors that can be filtered through using  
 * the defined filter methods. State values are set within the consturctor before binding the various defined methods. The search 
 * method is declared to accept the value being passed through by the searchbox component. The next and previous 
 * click buttons are also declared to change page state from the authors component. The render method then displays all the AuthorPage 
 * data using the Authors component along with the SearchBox with it being split into class divs to be styled.
 * 
 * @author Jacob Clark w18003237
*/

class AuthorPage extends React.Component {


    constructor(props) {
        super(props)
        this.state = {
            search: "",
            page: 1
        }
        this.handleSearch = this.handleSearch.bind(this);
        this.handleNextClick = this.handleNextClick.bind(this);
        this.handlePreviousClick = this.handlePreviousClick.bind(this);
    }


    handleSearch = (e) => {
        this.setState({ search: e.target.value })
    }

    handleNextClick = () => {
        this.setState({ page: this.state.page + 1 })
    }

    handlePreviousClick = () => {
        this.setState({ page: this.state.page - 1 })
    }

    render() {
        return (
            <div className="authorWrapper">
                <div className="header">
                    <h2>Author Collection</h2>
                    <p>Select an author to view a list of the papers they have contributed to. Select the papers to view addtional information</p>
                </div>

                <div className="filters">
                    <h2>Filter Results</h2>
                    <p>Search by authors full name:</p> <SearchBox search={this.state.search} handleSearch={this.handleSearch} />
                </div>

                <div className="authors">
                    <Authors search={this.state.search}
                        page={this.state.page}
                        handleNextClick={this.handleNextClick}
                        handlePreviousClick={this.handlePreviousClick} />
                </div>
            </div>
        )
    }
}

export default AuthorPage;