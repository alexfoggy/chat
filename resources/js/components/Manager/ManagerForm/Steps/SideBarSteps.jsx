import React from 'react'
import "./Radio.css"
import "./radioButton.css"

const styles = {
    label: {
        fontWeight: 'bold',
        color: 'black',
        marginBottom: '10px',
        fontSize: '18px'
    },
    nav: {
        display: 'flex',
        justifyContent: 'center',
        padding: '20px'
    },
    form_group: {
        display: 'block'
    }
}
export default function SideBarSteps() {
    return (
        <>
            <nav style={styles.nav} className="steps">
                <ul className="nav" style={{ display: 'flex', listStyle: 'none' }}>
                    <li className={location.pathname === "/manager/step1" ? "active_step" : "disable"}>
                        <div className="steps_page" to="/manager/step1">Step 1</div>
                    </li>
                    <li className={location.pathname === "/manager/step2" ? "active_step" : "disable"}>
                        <div className="steps_page" to="/manager/step2">Step 2</div>
                    </li>
                    <li className={location.pathname === "/manager/result" ? "active_step" : "disable"}>
                        <div className="steps_page" to="/manager/result">Result</div>
                    </li>
                </ul>
            </nav>
        </>
    )
}
