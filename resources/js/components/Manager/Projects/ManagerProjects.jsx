import React, { PureComponent } from 'react'
import { NavLink } from 'react-router-dom'
import { Button } from '@material-ui/core';
import '../../../../../public/ui/components/task.css'
import '../../../../../public/css/components/block.css'

export default class Project extends PureComponent {
    constructor(props) {
        super(props)
        this.state = {
            disabledButtons: [],
            search: '',

        }
    }



    render() {
        // const ProjectID = (project_id, index) => {
        //     axios.post('/manager/projects/generate', { project_id }).then(res => {
        //         console.log(res)
        //     })
        //     this.setState(oldState => {
        //         const newDisabledButtons = [...oldState.disabledButtons];
        //         newDisabledButtons[index] = true;
        //         return {
        //             inCart: true,
        //             disabledButtons: newDisabledButtons,
        //         }
        //     });
        // }
        const filter = this.props.spareParts.filter(p =>
            p.title.toLowerCase().includes(this.state.search.toLowerCase())
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
                        }}>Projects asdas</h2>
                        <input type="text" placeholder="Search..." style={{ marginBottom: '20px',padding:'10px 20px',borderRadius:'12px' }} onChange={e => this.setState({ search: e.target.value })} />
                        {filter.map((p, index) =>
                            <div key={p.id} className="task" style={{ width: '100%' }}>
                                {/* <div >
                                    <div>ID</div>
                                    <small style={{ margin: 0 }} className="price">{p.id}</small>
                                </div>
                                <div >
                                    <div>Title</div>
                                    <NavLink style={{ padding: 0 }} to={'/manager/projects/' + p.id}>{p.title}</NavLink>
                                </div>
                                <div >
                                    <div>Budjet</div>
                                    <small className="length">${p.budget}</small>
                                </div>

                                <div >
                                    <div>Sites count</div>
                                    <small className="deadline"> {p.tasks_count}</small>
                                </div>
                                <div >
                                    <div>Speaker</div>
                                    <small className="deadline">{p.speakers}</small>
                                </div> */}
                                <div className="buttons">
                                    {/* <Button variant="contained" disabled={this.state.disabledButtons[index]}
                                        onClick={() => ProjectID(p.id, index)}
                                        color="secondary" type="submit">Generate</Button> */}

                                </div>
                            </div>
                        )
                        }
                    </div>
                </div>
            </>
        )
    }
}
