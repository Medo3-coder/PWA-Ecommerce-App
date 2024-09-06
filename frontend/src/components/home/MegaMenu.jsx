import React, { useEffect } from 'react';

const MegaMenu = () => {

    // Define the event handler function separately
    const handleAccordionClick = (event) => {
        event.currentTarget.classList.toggle("active");
        const panel = event.currentTarget.nextElementSibling;
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    };

    useEffect(() => {
        const acc = document.getElementsByClassName("accordion");

        // Add event listeners
        for (let i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", handleAccordionClick);
        }

        // Cleanup function to remove event listeners on component unmount
        return () => {
            for (let i = 0; i < acc.length; i++) {
                acc[i].removeEventListener("click", handleAccordionClick);
            }
        };
    }, []); // Empty dependency array to run only on mount and unmount

    return (
        <div className="accordionMenuDiv">
            <div className="accordionMenuDivInside">

                <button className="accordion">
                    <img className="accordionMenuIcon" src="https://img.icons8.com/?size=50&id=53386&format=png" alt="icon" />
                    &nbsp; Man's Clothing
                </button>
                <div className="panel">
                    <ul>
                        <li><a href="ww" className="accordionItem"> Mans Tshirt 1</a></li>
                        <li><a href="ww" className="accordionItem"> Mans Tshirt 2</a></li>
                    </ul>
                </div>


                <button className="accordion">
                    <img className="accordionMenuIcon" src="https://img.icons8.com/?size=50&id=53386&format=png" alt="icon" />
                    &nbsp; Man's Clothing
                </button>
                <div className="panel">
                    <ul>
                        <li><a href="ww" className="accordionItem"> Mans Tshirt 1</a></li>
                        <li><a href="ww" className="accordionItem"> Mans Tshirt 2</a></li>
                    </ul>
                </div>


                <button className="accordion">
                    <img className="accordionMenuIcon" src="https://img.icons8.com/?size=50&id=53386&format=png" alt="icon" />
                    &nbsp; Man's Clothing
                </button>
                <div className="panel">
                    <ul>
                        <li><a href="ww" className="accordionItem"> Mans Tshirt 1</a></li>
                        <li><a href="ww" className="accordionItem"> Mans Tshirt 2</a></li>
                    </ul>
                </div>


                <button className="accordion">
                    <img className="accordionMenuIcon" src="https://img.icons8.com/?size=50&id=53386&format=png" alt="icon" />
                    &nbsp; Man's Clothing
                </button>
                <div className="panel">
                    <ul>
                        <li><a href="ww" className="accordionItem"> Mans Tshirt 1</a></li>
                        <li><a href="ww" className="accordionItem"> Mans Tshirt 2</a></li>
                    </ul>
                </div>



                <button className="accordion">
                    <img className="accordionMenuIcon" src="https://img.icons8.com/?size=50&id=53386&format=png" alt="icon" />
                    &nbsp; Man's Clothing
                </button>
                <div className="panel">
                    <ul>
                        <li><a href="ww" className="accordionItem"> Mans Tshirt 1</a></li>
                        <li><a href="ww" className="accordionItem"> Mans Tshirt 2</a></li>
                    </ul>
                </div>



                <button className="accordion">
                    <img className="accordionMenuIcon" src="https://img.icons8.com/?size=50&id=53386&format=png" alt="icon" />
                    &nbsp; Man's Clothing
                </button>
                <div className="panel">
                    <ul>
                        <li><a href="ww" className="accordionItem"> Mans Tshirt 1</a></li>
                        <li><a href="ww" className="accordionItem"> Mans Tshirt 2</a></li>
                    </ul>
                </div>



                <button className="accordion">
                    <img className="accordionMenuIcon" src="https://img.icons8.com/?size=50&id=53386&format=png" alt="icon" />
                    &nbsp; Man's Clothing
                </button>
                <div className="panel">
                    <ul>
                        <li><a href="ww" className="accordionItem"> Mans Tshirt 1</a></li>
                        <li><a href="ww" className="accordionItem"> Mans Tshirt 2</a></li>
                    </ul>
                </div>



                <button className="accordion">
                    <img className="accordionMenuIcon" src="https://img.icons8.com/?size=50&id=53386&format=png" alt="icon" />
                    &nbsp; Man's Clothing
                </button>
                <div className="panel">
                    <ul>
                        <li><a href="ww" className="accordionItem"> Mans Tshirt 1</a></li>
                        <li><a href="ww" className="accordionItem"> Mans Tshirt 2</a></li>
                    </ul>
                </div>



                <button className="accordion">
                    <img className="accordionMenuIcon" src="https://img.icons8.com/?size=50&id=53386&format=png" alt="icon" />
                    &nbsp; Man's Clothing
                </button>
                <div className="panel">
                    <ul>
                        <li><a href="ww" className="accordionItem"> Mans Tshirt 1</a></li>
                        <li><a href="ww" className="accordionItem"> Mans Tshirt 2</a></li>
                    </ul>
                </div>


                <button className="accordion">
                    <img className="accordionMenuIcon" src="https://img.icons8.com/?size=50&id=53386&format=png" alt="icon" />
                    &nbsp; Man's Clothing
                </button>
                <div className="panel">
                    <ul>
                        <li><a href="ww" className="accordionItem"> Mans Tshirt 1</a></li>
                        <li><a href="ww" className="accordionItem"> Mans Tshirt 2</a></li>
                    </ul>
                </div>

                {/* Repeat the button and panel block as needed */}

            </div>
        </div>
    );
};

export default MegaMenu;
