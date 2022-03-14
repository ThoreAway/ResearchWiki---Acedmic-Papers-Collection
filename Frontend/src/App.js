import React from 'react';
import { BrowserRouter, Routes, Link, Route } from 'react-router-dom';
import HomePage from './components/HomePage.js'
import PaperPage from './components/PaperPage.js';
import AuthorPage from './components/AuthorPage.js';
import NotFound from './components/NotFound.js';
import ReadingListPage from './components/ReadingListPage.js';
import logo from "./img/logo2.png"

import './App.css';



/**
 * Main app 
 * 
 * Uses BrowserRouter to togle between each of the defined pages 
 * Also features a basic footer with relevant information
 *
 * @author Jacob Clark w18003237
*/

function App() {
  return (
    <BrowserRouter  basename={'/kf6012/coursework/part2'}>
      <div className="App">
        <nav className="navbar">
          <img src={logo} alt="Page Logo"></img>
          <Link to="readinglist">Reading List</Link>
          <Link to="authors">Authors</Link>
          <Link to="papers">Papers</Link>
          <Link to="/">Home</Link>
        </nav>

        <nav className='pageContent'>
          <Routes>
            <Route path="/" element={<HomePage />} />
            <Route path="/papers" element={<PaperPage />} />
            <Route path="/authors" element={<AuthorPage />} />
            <Route path="readinglist" element={<ReadingListPage />} />
            <Route path="*" element={<NotFound />} />
          </Routes>
        </nav>

        <footer>
          <div className="footer">
            <p>Jacob Clark  W18003237</p>
            <p><a href="jacob.clark@northumbria.ac.uk">jacob.clark@northumbria.ac.uk</a></p>
            <p>This web application and its relevant API endpoints are university coursework and are not affliated with the DIS or any research companies.</p>
          </div>
        </footer>

      </div>
    </BrowserRouter>

  );
}

export default App;
