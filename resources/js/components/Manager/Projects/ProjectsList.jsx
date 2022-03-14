import React, { useState } from 'react'
import { NavLink } from 'react-router-dom'
import { Button } from '@material-ui/core'
import '../../../../../public/ui/components/task.css'
import '../../../../../public/css/components/block.css'

export default function ProjectList(props) {

    const [search, setSearch] = useState('')
    const [disabledButtons, setDisabledButtons] = useState([])


    // const ProjectID = (project_id, index) => {
    //     axios.post('/manager/projects/generate', { project_id }).then(res => {
    //         console.log(res)
    //     })
    //     const newDisabledButtons = [...disabledButtons]
    //     newDisabledButtons[index] = true
    //     setDisabledButtons(newDisabledButtons)
    // }

    const filter = props.spareParts.filter(p =>
        p.title.toLowerCase().includes(search.toLowerCase())
    )

    return (
        <>
            <div className="block">
                <div className="block-content">
                    <h2 style={{
                        fontWeight: 'bold',
                        color: '#d11267',
                        paddingBottom: '30px',
                        margin: 0
                    }}>Projects</h2>
                    <input type="text" placeholder="Search..." style={{ marginBottom: '20px',borderRadius:'12px',padding:'10px 20px' }} onChange={e => setSearch(e.target.value)} />
                    {filter.map((p, index) =>
                        <div key={p.id} className="task" style={{ width: '100%' }}>
                            <div >
                                <div>ID</div>
                                <small style={{ margin: 0  }} className="price">{p.id}</small>
                            </div>
                            <div >
                                <div>Title</div>
                                <NavLink style={{ padding: 0, fontWeight: 900 }} to={'/manager/projects/' + p.id}>{p.title}</NavLink>
                            </div>
                            <div >
                                <div>Budget</div>
                                <small className="length">${p.budget}</small>
                            </div>

                            <div >
                                <div>Tasks count</div>
                                <small className="deadline"> {p.tasks_count}</small>
                            </div>
                            <div >
                                <div>Speakers</div>
                                <small className="deadline">{p.speakers}</small>
                            </div>
                            {/* <div className="buttons">
                                <Button variant="contained" disabled={disabledButtons[index]}
                                    onClick={() => ProjectID(p.id, index)}
                                    color="secondary" type="submit">Generate</Button>
                            </div> */}
                        </div>
                    )
                    }
                </div>
            </div>
        </>
    )

}
