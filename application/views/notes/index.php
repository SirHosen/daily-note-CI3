<div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 mb-4">
        <div class="sidebar">
            <!-- Search Box -->
            <div class="search-box mb-4">
                <form action="<?php echo base_url('notes/search'); ?>" method="get">
                    <i class="fas fa-search"></i>
                    <input type="text" name="q" class="form-control" placeholder="Search notes..." 
                           value="<?php echo isset($search_term) ? $search_term : ''; ?>">
                </form>
            </div>
            
            <!-- Categories -->
            <h5 class="mb-3"><i class="fas fa-folder"></i> Categories</h5>
            <div class="list-group">
                <a href="<?php echo base_url('notes'); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    All Notes
                    <span class="badge bg-primary rounded-pill">
                        <?php echo array_sum(array_column($categories, 'note_count')); ?>
                    </span>
                </a>
                <?php foreach($categories as $category): ?>
                    <a href="<?php echo base_url('notes/category/'.$category['id']); ?>" 
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <span>
                            <span class="badge" style="background-color: <?php echo $category['color']; ?>">
                                &nbsp;&nbsp;
                            </span>
                            <?php echo $category['name']; ?>
                        </span>
                        <span class="badge bg-secondary rounded-pill"><?php echo $category['note_count']; ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
						
            <!-- Quick Actions -->
            <div class="mt-4">
                <a href="<?php echo base_url('notes/create'); ?>" class="btn btn-primary w-100">
                    <i class="fas fa-plus"></i> Create New Note
                </a>
            </div>
        </div>
    </div>
    
    <!-- Notes Grid -->
    <div class="col-md-9">
        <?php if(isset($search_term)): ?>
            <h4 class="mb-4">Search results for: "<?php echo $search_term; ?>"</h4>
        <?php endif; ?>
        
        <?php if(empty($notes)): ?>
            <div class="text-center py-5">
                <i class="fas fa-sticky-note fa-4x text-muted mb-3"></i>
                <h5 class="text-muted">No notes found</h5>
                <p class="text-muted">Start by creating your first note!</p>
                <a href="<?php echo base_url('notes/create'); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create Note
                </a>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach($notes as $note): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card note-card <?php echo $note['is_important'] ? 'important-note' : ''; ?>">
                            <div class="card-body">
                                <!-- Category & Important Badge -->
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <?php if($note['category_name']): ?>
                                        <span class="badge category-badge" 
                                              style="background-color: <?php echo $note['category_color']; ?>">
                                            <?php echo $note['category_name']; ?>
                                        </span>
                                    <?php else: ?>
                                        <span></span>
                                    <?php endif; ?>
                                    
                                    <?php if($note['is_important']): ?>
                                        <i class="fas fa-star text-warning"></i>
                                    <?php endif; ?>
                                </div>
                                
                                <!-- Note Title -->
                                <h5 class="card-title">
                                    <a href="<?php echo base_url('notes/view/'.$note['id']); ?>" 
                                       class="text-decoration-none text-dark">
                                        <?php echo character_limiter($note['title'], 50); ?>
                                    </a>
                                </h5>
                                
                                <!-- Note Content Preview -->
                                <p class="note-content">
                                    <?php echo character_limiter(strip_tags($note['content']), 100); ?>
                                </p>
                                
                                <!-- Date & Actions -->
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <small class="text-muted">
                                        <i class="far fa-clock"></i>
                                        <?php echo date('M d, Y', strtotime($note['created_at'])); ?>
                                    </small>
                                    
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?php echo base_url('notes/toggle_important/'.$note['id']); ?>" 
                                           class="btn btn-outline-warning" title="Toggle Important">
                                            <i class="fas fa-star"></i>
                                        </a>
                                        <a href="<?php echo base_url('notes/edit/'.$note['id']); ?>" 
                                           class="btn btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="confirmDelete('<?php echo base_url('notes/delete/'.$note['id']); ?>')" 
                                                class="btn btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
