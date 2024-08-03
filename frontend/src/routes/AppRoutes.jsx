import React, { Component, Fragment } from 'react'
import { Link } from "react-router-dom";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import  HomePage from'../pages/Home';


export class AppRoutes extends Component {
  render() {
    return (
      <Fragment>
              {/* <Link as={Link} to="/"> Home</Link> */}

              <Routes>
                    <Route path="/" element={<HomePage />}></Route>
                    {/* <Route path="/profile" element={<Profile />}></Route>
                    <Route path="/blog" element={<Blog />}></Route>
                    <Route path="/contact" element={<Contact />}></Route>
                    <Route path="/about" element={<About />}></Route> */}

                </Routes>

      </Fragment>

      
    )
  }
}

export default AppRoutes