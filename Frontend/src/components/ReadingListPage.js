import React from "react";
import Login from "./Login.js";
import Logout from "./Logout.js";
import ReadingList from "./ReadingList.js";

/**
 * readinglistpage used to build up the content displayed within the readinglist
 *  
 * It uses a variety of methods annd functions declared in child components to log a user in and display their readinglist with its 
 * checkboxes. These include getting the password and username passed from the login form along within log in and log out process  
 * functions.
 * 
 *
 * @author Jacob Clark w18003237
*/

class ReadingListPage extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            authenticated: false,
            username: "",
            password: "",
            page: 1,
            token: null
        }

        this.handleUsername = this.handleUsername.bind(this);
        this.handlePassword = this.handlePassword.bind(this);
        this.handleLoginClick = this.handleLoginClick.bind(this);
        this.handleLogoutClick = this.handleLogoutClick.bind(this);
        this.handleNextClick = this.handleNextClick.bind(this);
        this.handlePreviousClick = this.handlePreviousClick.bind(this);
    }



    componentDidMount() {
        if (localStorage.getItem('myReadingListToken')) {
            this.setState(
                {
                    authenticated: true,
                    token: localStorage.getItem('myReadingListToken')
                }
            );
        }
    }

    handlePassword = (e) => {
        this.setState({ password: e.target.value })
    }

    handleUsername = (e) => {
        this.setState({ username: e.target.value })
    }

    /**
    * handleLoginClick
    *
    * sends a post request to the authenticate endpoint with the username and password given as form data. Sucessful athentication *
    * will return a 200 status code and if the results include jwt, authenticated is set to true and the token is stored within the 
    * browsers local stroage so the user can navigate to and from the reading list without having to log back in.
    *
    */
    handleLoginClick = () => {
        let url = "http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api/authenticate"

        let formData = new FormData();
        formData.append('username', this.state.username);
        formData.append('password', this.state.password);

        fetch(url, {
            method: 'POST',
            headers: new Headers(),
            body: formData
        })
            .then((response) => {
                if (response.status === 200) {
                    return response.json()
                } else {
                    throw Error(response.statusText)
                }
            })
            .then((data) => {
                if ("token" in data.results) {
                    this.setState(
                        {
                            authenticated: true,
                            token: data.results.token
                        })
                    localStorage.setItem('myReadingListToken', data.results.token);
                }
            })
            .catch((err) => {
                console.log("something went wrong ", err)
            }
            );
    }

    /**
    * handleLogoutClick
    *
    * simply resets authentication status back to false and removes the readinglisttoken from the browsers local storage.
    *
    */
    handleLogoutClick = () => {
        this.setState(
            {
                authenticated: false,
                token: null
            })

        localStorage.removeItem('myReadingListToken');
    }

    handleNextClick = () => {
        this.setState({ page: this.state.page + 1 })
    }

    handlePreviousClick = () => {
        this.setState({ page: this.state.page - 1 })
    }

    /**
    * render method
    *
    * displays relevant data based on authenticated state using child component ReadingList. Wrapped in divs for styling process
    *
    */
    render() {

        let page = (
            <div className="readingListLoginWrapper">

                <div className="header">
                    <h2>Login Form</h2>
                    <p>Please log in with your username and password to access your reading list</p>
                </div>

                <div className="loginForm">
                    <Login
                        handleUsername={this.handleUsername}
                        handlePassword={this.handlePassword}
                        handleLoginClick={this.handleLoginClick} />
                </div>
            </div>
        )
        if (this.state.authenticated) {
            page = (
                <div className="readingListWrapper">

                    <div className="logoutButton">
                        <Logout handleLogoutClick={this.handleLogoutClick} />
                    </div>

                    <div className="header">
                        <h2>Reading List</h2>
                        <p>Check off papers you wish to read later </p>
                    </div>

                    <div className="readinglist">
                        <ReadingList token={this.state.token}
                            page={this.state.page}
                            handleNextClick={this.handleNextClick}
                            handlePreviousClick={this.handlePreviousClick} />
                    </div>
                </div>
            )
        }

        return (
            <div>{page}</div>
        )
    }
}

export default ReadingListPage;