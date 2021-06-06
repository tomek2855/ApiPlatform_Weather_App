import React from "react";
import './Layout.css';
import {Link} from "react-router-dom";

function Layout({children}) {

    return (
        <div>
            <div className="navbar navbar-expand-lg navbar-dark bg-dark">
                <div className="container">
                    <Link to={"/"} className="navbar-brand">Weather</Link>
                </div>
            </div>

            <div className="Layout-children">
                <div className="container">
                    {children}
                </div>
            </div>
        </div>
    );
}

export default Layout;